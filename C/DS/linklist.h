#define OK      1
#define ERROR   1

#define INIT_SIZE 10

typedef int Status;
typedef int ElemType;

typedef struct Node{
    ElemType value;
    struct Node *next;
}Node, *LinkList;

Status
Init( LinkList );

Status
Insert( LinkList , const ElemType value );

LinkList *
Delete( LinkList , const ElemType value );

Status
Find( const LinkList , const ElemType value );

Status
IsEmpty( LinkList );
