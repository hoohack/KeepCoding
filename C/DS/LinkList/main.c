#include <stdio.h>
#include "linklist.h"
#include "common.h"

int main()
{
    LinkList *head = NULL;
    init(&head);
    int i = 0;
    for( i = 1; i <= 10; ++i )
    {
            insert(&head, i);
    }
	insert(&head, 0);
	insert(&head, -1);
    print_list(head);
    if( remove_by_val(&head, 9) )
		printf("remove 9 success\n");
	else
		printf("remove 9 failed element not exist\n");

	if( remove_by_val(&head, 19) )
		printf("remove 19 success\n");
	else
		printf("remove 19 failed element not exist\n");

    print_list(head);

    if( find(head, 1) )
        printf("Found 1\n");

    if( find(head, 20) )
        printf("20 Not Found\n");

    if( is_empty(head) )
        printf("List Empty\n");

    return 0;
}
