#include "list.h"

typedef struct ListNode {
	void *value;
	struct ListNode *next;
	struct ListNode *prev;
} ListNode;

typedef struct List {
	int (*compare)(const void *, const void *);

	struct ListNode *head;
	struct ListNode *tail;
	size_t length;
} List;

size_t list_length(const List *L) { return L->length; }

List *list_create(int (*compare)(const void *, const void *))
{
	List *L = malloc(sizeof(List));
	if (L == NULL) {
		printf("malloc failed\n");
		exit(1);
	}
	memset(L, 0, sizeof(List));
	L->length = 0;
	L->compare = compare;

	return L;
}

void _do_insert(List *L, ListNode *node)
{
	node->next = L->head;
	if (!IS_NULL(L->head))
		L->head->prev = node;
	L->head = node;
	node->prev = NULL;
	++L->length;
	if (IS_NULL(L->head->next))
		L->tail = node;
}

void list_insert(List *L, void *value)
{
	ListNode *node = malloc(sizeof(ListNode));
	node->value = value;
	_do_insert(L, node);
}

ListNode *list_search(const List *L, const void *value)
{
	ListNode *walk = L->head;
	while (walk != NULL) {
		if (L->compare(walk->value, value) == 0)
			return walk;
		walk = walk->next;
	}

	return NULL;
}

void *_do_delete(List *L, ListNode *del_node)
{
	void *val = del_node->value;
	if (!IS_NULL(del_node->prev))
		del_node->prev->next = del_node->next;
	else
		L->head = del_node->next;

	if (!IS_NULL(del_node->next))
		del_node->next->prev = del_node->prev;
	free(del_node);
	return val;
}

void *list_delete(List *L, const void *value)
{
	ListNode *del_node = list_search(L, value);
	if (!IS_NULL(del_node))
		return _do_delete(L, del_node);
	return NULL;
}

void list_traversal(List *L, void (*visit_func)(void *))
{
	ListNode *p = L->head;
	while (!IS_NULL(p)) {
		visit_func(p->value);
		p = p->next;
	}
}

void list_retraversal(List *L, void (*visit_func)(void *))
{
	ListNode *p = L->tail;
	while (!IS_NULL(p)) {
		visit_func(p->value);
		p = p->prev;
	}
}
