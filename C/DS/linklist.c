#include <stdlib.h>
#include <stdio.h>

#define OK 1
#define ERROR 0

typedef int Status;
typedef int ElemType;

typedef struct Node{
    ElemType value;
    struct Node *next;
}Node, *LinkList;


Status
Init( LinkList *head )
{
    *head = ( LinkList )malloc( sizeof( Node ) );
    if( *head == NULL )
    {
        return ERROR;
    }
    (*head)->next = NULL;
    return OK;
}

Status
Insert( LinkList list, const ElemType value )
{
    LinkList new_node = ( LinkList )malloc( sizeof( Node ) );
    LinkList q = NULL, p = NULL;
    new_node->value = value;
    new_node->next = NULL;
    if( list->next == NULL )
    {
        list->next = new_node;
        return OK;
    }
    p = list->next;
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
IsEmpty( LinkList list )
{
    return list->next == NULL;
}

void
PrintList(  LinkList L)
{
    while( L )
    {
        printf("%d ", L->value);
        L = L->next;
    }

    printf("\n");
}

int
main()
{
    LinkList *head = NULL;
    Init(head);
    return 0;
    int i = 0;
    for( i = 0; i < 10; ++i )
    {
        Insert(*head, i);
    }
    PrintList(*head);
}
