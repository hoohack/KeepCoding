#include <stdlib.h>
#include <stdio.h>

#include "linklist.h"

/**
 * 初始化链表
 */
Status init(LinkList **head)
{
    LinkList *node = (LinkList *)malloc(sizeof(LinkList));
    if( node == NULL ) return ERROR;

    *head = node;
    return OK;
}

/**
 * 插入value到链表中
 */
Status insert(LinkList **list, ElemType value)
{
	LinkList *current = NULL;
	LinkList *new_node = NULL;

	list = &(*list)->next;

	while((current = *list) != NULL && current->value < value)
		list = &current->next;

    new_node = (LinkList *)malloc(sizeof(LinkList));
    if( new_node == NULL ) return ERROR;
    new_node->value = value;

	new_node->next = current;
	*list = new_node;

    return OK;
}

/**
 * 删除链表中的value值
 */
Status remove_by_val(LinkList **list, ElemType value)
{
    LinkList *current = *list;
    LinkList *previous = NULL;

    while(current != NULL && current->value != value)
    {
		previous = current;
        current = current->next;
    }

    if( current != NULL )
       previous->next = current->next;
	else
		return FALSE;

    free(current);

    return TRUE;
}

/**
 * 在链表中查找value值
 */
Status find(const LinkList *list, ElemType value)
{
	list = list->next;

    while( list != NULL && list->value != value )
        list = list->next;

    return list != NULL ? TRUE : FALSE;
}

/**
 * 判断链表是否为空
 */
Status is_empty(LinkList *list)
{
	return list->next == NULL;
}
