#include "common.h"
#include <stdio.h>

void
PrintList(  LinkList *list)
{
    LinkList *p = list->next;
    while( p != NULL )
    {
        printf("%d ", p->value);
        p = p->next;
    }

    printf("\n");
}
