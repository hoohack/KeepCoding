#include <stdio.h>
#include "linklist.h"
#include "common.h"
#include <stdlib.h>

int main()
{
	LinkList *head = NULL;
	init(&head);
	int i = 0;
	int *data = NULL;
	int *new_val1 = malloc(sizeof(int));
	*new_val1 = 0;
	int *new_val2 = malloc(sizeof(int));
	*new_val2 = -1;
	int *rm_val1 = malloc(sizeof(int));
	*rm_val1 = 9;
	int *rm_val2 = malloc(sizeof(int));
	*rm_val2= 19;
	int *find_val1 = malloc(sizeof(int));
	*find_val1 = 1;
	int *find_val2 = malloc(sizeof(int));
	*find_val2 = 20;
	for( i = 1; i <= 10; ++i )
	{
		data = malloc(sizeof(int));
		*data = i;
		insert(&head, data);
	}
	insert(&head, new_val1);
	insert(&head, new_val2);
	print_list(head);
	if( remove_by_val(&head, rm_val1) )
		printf("remove 9 success\n");
	else
		printf("remove 9 failed element not exist\n");

	if( remove_by_val(&head, rm_val2) )
		printf("remove 19 success\n");
	else
		printf("remove 19 failed element not exist\n");

	print_list(head);

	if( find(head, find_val1) )
		printf("Found 1\n");

	if( find(head, find_val2) )
		printf("20 Not Found\n");

	if( is_empty(head) )
		printf("List Empty\n");

	return 0;
}
