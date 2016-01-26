#include <stdlib.h>
#include <stdio.h>

#include "linklist.h"

Status
Init( LinkList **head )
{
    LinkList *node = ( LinkList *)malloc( sizeof( LinkList ) );
    if( node == NULL )
    {
        return ERROR;
    }
    *head = node;
    return OK;
}

Status
Insert( LinkList **list, const ElemType value )
{
    LinkList *new_node = ( LinkList * )malloc( sizeof( LinkList ) );
    if( new_node == NULL )
    {
        return ERROR;
    }
    LinkList *q = NULL, *p = NULL;
    new_node->value = value;
    new_node->next = NULL;
    if( (*list)->next == NULL )
    {
        (*list)->next = new_node;
        return OK;
    }
    p = (*list);
    q = p->next;
    while( q->next != NULL && q->value < value )
    {
        p = p->next;
        q = p->next;
    }
    if( q->next == NULL )
    {
        q->next = new_node;
        return OK;
    }
    p->next = new_node;
    new_node->next = q;
    return OK;
}

Status
Delete( LinkList **list, const ElemType value )
{
    LinkList *current = *list;
    LinkList *p = NULL;
    if( current->next == NULL )
    {
        return ERROR;
    }
    p = current;
    current = current->next;
    while( current && current->value != value )
    {
        p = current;
        current = current->next;
    }
    if( current != NULL )
    {
       p->next = current->next; 
    }

    free( current );

    return OK;
}

Status
Find( LinkList *list, const ElemType value )
{
    LinkList *current = list;
    if( current->next == NULL )
    {
        return ERROR;
    }
    while( current && current->value != value )
    {
        current = current->next;
    }

    return current != NULL ? OK : ERROR;
}

Status
IsEmpty( LinkList *list )
{
    return list->next == NULL;
}
