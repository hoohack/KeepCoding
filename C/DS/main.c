#include <stdio.h>
#include "linklist.h"
#include "common.h"

int
main()
{
    LinkList *head = NULL;
    Init(&head);
    int i = 0;
    for( i = 0; i < 10; ++i )
    {
            Insert(&head, i);
        }
    PrintList(head);
    Delete(&head, 9);
    PrintList(head);
    if( Find(head, 1) )
    {
            printf("Found 1\n");
        }
    if( Find(head, 20) )
    {
            printf("20 Not Found\n");
        }
    if( IsEmpty(head) )
    {
            printf("List Empty\n");
        }

    return 0;
}
