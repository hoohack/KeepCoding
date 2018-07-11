#include <stdio.h>
#include <sys/socket.h>
#include <stdlib.h>
#include <netinet/in.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>

#define SERVER_PORT 9001
#define MAX_BUFF_SIZE 4096
#define MAX_BACK_LOG 1024

int main()
{
	int server_fd = 0;
	int conn_fd = 0;
	struct sockaddr_in servaddr;
	struct sockaddr_in clientaddr;
	socklen_t addr_len;
	char buff[MAX_BUFF_SIZE];
	int n = 0;

	if ((server_fd = socket(AF_INET, SOCK_STREAM, 0)) == -1) {
		perror("socket error");
		exit(-1);
	}

	memset(&servaddr, 0, sizeof(servaddr));
	servaddr.sin_family = AF_INET;
	servaddr.sin_port = htons(SERVER_PORT);
	if (inet_pton(AF_INET, "0.0.0.0", &servaddr.sin_addr) <= 0) {
		perror("inet_pton error");
		exit(-1);
	}

	/* 使端口马上可用 */
	int on = 1;
	if (setsockopt(server_fd, SOL_SOCKET, SO_REUSEADDR, &on, sizeof(int)) <
			0) {
		perror("setsockopt");
		exit(-1);
	}

	if (bind(server_fd, (struct sockaddr*)&servaddr, sizeof(servaddr)) == -1) {
		perror("bind error");
		exit(-1);
	}

	if (listen(server_fd, MAX_BACK_LOG) == -1) {
		perror("listen error");
		exit(-1);
	}

	printf("server running...listen port %d\n", SERVER_PORT);

	while(1) {
		if ((conn_fd = accept(server_fd, (struct sockaddr *)&clientaddr, &addr_len)) == -1) {
			perror("accept error");
			continue;
		}

		printf("client %d connected, waiting for data\n", conn_fd);

		n = read(conn_fd, buff, MAX_BUFF_SIZE);
		buff[n] = '\0';
		printf("recv msg from client_%d: %s\n", conn_fd, buff);
		close(conn_fd);
	}

	close(server_fd);
}
