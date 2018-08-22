/*
 * blocking server - multi thread version
 */
#include <arpa/inet.h>
#include <errno.h>
#include <netinet/in.h>
#include <netinet/ip.h>
#include <pthread.h>
#include <signal.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <unistd.h>

static const int DEFAULT_BUFFER_SIZE = 1024;
static const int DEFAULT_BACKLOG = 1024;
static const int LISTENING_PORT = 9999;

static int stop_flag = 0;

static void sigterm_handler(int sig)
{
	char *msg = "Receive SIGTERM signal, stop server.\n";
	write(STDOUT_FILENO, msg, strlen(msg));
	stop_flag = 1;
}

/*
 * handle request by simply echo what client send
 * @param 	client_fd
 * @return 	int
*/
void *handle_request(void *arg)
{
	char buffer[DEFAULT_BUFFER_SIZE];
	int size;
	int client_fd = (int)(long)arg;
	int *ret;
	ret = (void *)(long)0;

	while ((size = read(client_fd, buffer, DEFAULT_BUFFER_SIZE)) != 0) {
		if (size == -1) {
			if (errno == EINTR) {
				continue;
			}

			perror("Fail to recv from client");
			goto END_REQUEST;
		}

		write(STDOUT_FILENO, buffer, size);
		if (size >= 4 &&
		    memcmp("\r\n\r\n", buffer + size - 4, 4) == 0) {
			break;
		}
	}

	size =
	    snprintf(buffer, DEFAULT_BUFFER_SIZE, "HTTP/1.1 200 OK\r\n"
						  "Content-Length: 21\r\n\r\n"
						  "<h1>Hello world!</h1>");

	int wsize = write(client_fd, buffer, size);
	if (wsize == -1) {
		perror("Fail to send to client.");
		goto END_REQUEST;
	}

	if (size != wsize) {
		fprintf(stderr, "Fail to send all data to client");
	}

	if (close(client_fd) == -1) {
		perror("Fail to close client.");
		goto END_REQUEST;
	}

	return ret;

END_REQUEST:;
	ret = (void *)(long)errno;
	return ret;
}

int main(int argc, char *argv[])
{
	int fd = socket(AF_INET, SOCK_STREAM, 0);
	if (fd == -1) {
		perror("Fail to create socket");
		exit(-1);
	}

	struct sockaddr_in bind_addr;
	bind_addr.sin_family = AF_INET;
	bind_addr.sin_port = htons(LISTENING_PORT);
	if (inet_aton("0.0.0.0", &bind_addr.sin_addr) == 0) {
		perror("Fail to parse net address");
		exit(-1);
	}

	if (bind(fd, (struct sockaddr *)&bind_addr, sizeof(bind_addr)) == -1) {
		perror("Fail to bind");
		exit(-1);
	}

	if (listen(fd, DEFAULT_BACKLOG) == -1) {
		perror("Fail to listen");
		exit(-1);
	}

	struct sockaddr_in peer_addr;
	socklen_t addr_len = sizeof(peer_addr);

	// register SIGTERM handler
	struct sigaction term_action;
	term_action.sa_handler = sigterm_handler;
	term_action.sa_flags = SA_NODEFER;
	if (sigaction(SIGTERM, &term_action, NULL) == -1) {
		perror("Fail to catch SIGTERM signal.");
	}

	char *msg = "Listening...\n\n";
	write(STDOUT_FILENO, msg, strlen(msg));
	while (!stop_flag) {
		int cfd = 0;
		cfd = accept(fd, (struct sockaddr *)&peer_addr, &addr_len);
		if (cfd == -1) {
			if (errno == EINTR) {
				continue;
			}

			perror("Fail to accept client request.");
			exit(-1);
		}

		pthread_t t_id;
		if (pthread_create(&t_id, NULL, handle_request,
				   (void *)(long)cfd) != 0) {
			perror("Fail to create thread.");
			exit(-1);
		}
	}

	msg = "Stop listening!\n";
	write(STDOUT_FILENO, msg, strlen(msg));

	if (close(fd) == -1) {
		perror("Fail to close socket");
		exit(-1);
	}

	return 0;
}
