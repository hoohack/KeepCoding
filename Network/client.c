#include <stdio.h>
#include <stdlib.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <string.h>
#include <arpa/inet.h>
#include <unistd.h>

#define SERVER_PORT 9001
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
	if (inet_pton(AF_INET, argv[1], &servaddr.sin_addr) <=0) {
		perror("inet_pton error");
		exit(-1);
	}

	if (connect(sockfd, (struct sockaddr*)&servaddr, sizeof(servaddr)) < 0) {
		perror("connect");
		exit(-1);
	}

	printf("send msg to server: \n");

	fgets(send_line, BUFF_SIZE, stdin);
	if (send(sockfd, send_line, strlen(send_line), 0) < 0) {
		perror("send");
		exit(-1);
	}

	close(sockfd);
	exit(0);
}
