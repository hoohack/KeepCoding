#ifndef _List_H
#define _List_H

#define OK      1
#define ERROR   0
#define TRUE	1
#define FALSE	0

typedef int Status;
typedef int ElemType;

typedef struct node{
	ElemType value;	/* 结点值 */
	struct node *next;	/* 下一个结点的指针 */
}LinkList;

Status init(LinkList **head);	/* 初始化链表 */
Status insert(LinkList **list, ElemType value);
Status remove_by_val(LinkList **list, ElemType value);
Status find(const LinkList *list, ElemType value);
Status is_empty(LinkList *list);


#endif /* List_H */
