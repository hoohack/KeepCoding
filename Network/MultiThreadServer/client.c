#include <arpa/inet.h>
#include <netinet/in.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h>
#include <unistd.h>

#define SERVER_PORT 9999
#define BUFF_SIZE 4096

int main(int argc, char **argv)
{
	int sockfd, n;
	char recv_line[BUFF_SIZE], send_line[BUFF_SIZE];

	struct sockaddr_in servaddr;

	if (argc != 2) {
		printf("usage: ./client <ipaddress>\n");
		exit(-1);
	}

	if ((sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0) {
		perror("socket error");
		exit(-1);
	}

	memset(&servaddr, 0, sizeof(servaddr));
	servaddr.sin_family = AF_INET;
	servaddr.sin_port = htons(SERVER_PORT);
	if (inet_pton(AF_INET, argv[1], &servaddr.sin_addr) <= 0) {
		perror("inet_pton error");
		exit(-1);
	}

	if (connect(sockfd, (struct sockaddr *)&servaddr, sizeof(servaddr)) <
	    0) {
		perror("connect");
		exit(-1);
	}

	printf("send msg to server: \n");

	int count = 0;
	do {
		if (fgets(send_line, sizeof(send_line), stdin) == NULL) {
			break;
		}
		send(sockfd, send_line, strlen(send_line), 0); ///发送
		if (strcmp(send_line, "exit\n") == 0)
			break;
		while (1) {
			recv(sockfd, recv_line, sizeof(recv_line), 0); ///接收
			fputs(recv_line, stdout);
		}

		memset(send_line, 0, sizeof(send_line));
		memset(recv_line, 0, sizeof(recv_line));
	} while (0);

	close(sockfd);
	exit(0);
}
