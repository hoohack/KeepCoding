#include "common.h"
#include <stdio.h>

/**
 * 打印链表
 */
void print_list(const LinkList *list)
{
    while( (list = list->next) != NULL )
        printf("%2d ", list->value);
    printf("\n");
}
