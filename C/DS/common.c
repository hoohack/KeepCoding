#include "common.h"
#include <stdio.h>

void
PrintList( const LinkList L)
{
    while( L )
    {
        printf("%d ", L->value);
        L = L->next;
    }

    printf("\n");
}
