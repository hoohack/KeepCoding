#ifndef _List_H
#define _List_H
#define OK      1
#define ERROR   1

typedef int Status;
typedef int ElemType;

typedef struct Node{
    ElemType value;
    struct Node *next;
}LinkList;

Status
Init( LinkList **head );

Status
Insert( LinkList **list, const ElemType value );

Status
Delete( LinkList **list, const ElemType value );

Status
Find( LinkList *list, const ElemType value );

Status
IsEmpty( LinkList *list );

#endif /* List_H */
