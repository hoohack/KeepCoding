/*
 * fork demo
*/

#include <signal.h>
#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
#include <wait.h>

static void sigchld_handler(int sig)
{
	int status;
	pid_t pid;
	while ((pid = waitpid(-1, &status, WNOHANG)) > 0) {
		printf("process %d exit\n", pid);
	}
}

int main()
{
	pid_t pid;
	int res = 0;

	signal(SIGCHLD, sigchld_handler);
	// register SIGCHLD handler
	struct sigaction chld_action;
	chld_action.sa_handler = sigchld_handler;
	chld_action.sa_flags = SA_NODEFER;
	res = sigaction(SIGCHLD, &chld_action, NULL);

	if (res == -1) {
		perror("Oh! Can not catch SIGCHLD signal. :) ");
	}

	if ((pid = fork()) < 0) {
		perror("fork error");
		exit(-1);
	} else if (pid == 0) {
		printf("fork success process id: %d\n", getpid());
	} else {
		printf("parent process id: %d\n", getpid());
		sleep(10);
	}

	return 0;
}
