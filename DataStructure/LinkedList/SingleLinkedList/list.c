#include "list.h"

typedef struct LinkNode {
	void *value;
	struct LinkNode *next;
} LinkNode;

typedef struct List {
	int (*compare)(void *const, void *const);

	struct LinkNode *head;
	struct LinkNode *tail;
	size_t length;
} List;

LinkedListAPI size_t list_length(const List *const L) { return L->length; }

LinkedListAPI List *list_create(int (*compare)(void *const, void *const))
{
	List *L = malloc(sizeof(List));
	if (IS_NULL(L)) {
		perror("malloc list failed\n");
	}

	memset(L, 0, sizeof(List));
	L->length = 0;
	L->compare = compare;
	L->head = NULL;
	L->tail = NULL;

	return L;
}

LinkedListAPI void list_insert(List *L, void *const value)
{
	if (IS_NULL(L)) {
		perror("List is null\n");
	}

	LinkNode *node = malloc(sizeof(LinkNode));
	if (IS_NULL(node)) {
		perror("malloc node failed\n");
	}
	node->value = value;
	node->next = NULL;

	if (L->length == 0) {
		L->head = node;
		L->tail = node;
		L->length++;
		return;
	}

	L->length++;
	LinkNode *p = L->head;

	while (p) {
		if (L->compare(p->value, value) == -1) {
			p = p->next;
		} else {
			break;
		}
	}

	if (IS_NULL(p)) {
		L->tail->next = node;
		L->tail = node;
	} else {
		node->next = p->next;
		p->next = node;
	}
}

LinkedListAPI void list_delete(List *L, void *const value)
{
	if (IS_NULL(L)) {
		perror("List is null\n");
	}

	if (L->length == 0) {
		printf("List is empty\n");
		return;
	}

	LinkNode *p = L->head;
	printf("%d\n", *(int *)p->value);
	LinkNode *q = NULL;
	while (p) {
		if (L->compare(p->value, value) != 0) {
			q = p;
			p = p->next;
		} else {
			break;
		}
	}

	if (IS_NULL(p)) {
		printf("list has no such value\n");
		return;
	}

	if (p == L->head) {
		L->head = p->next;
	} else {
		q->next = p->next;
		if (p == L->tail) {
			L->tail = q;
		}
	}

	p->next = NULL;
	free(p);
	L->length--;
}

LinkedListAPI void list_traversal(List *const L,
				  void (*visit_func)(void *const))
{
	if (IS_NULL(L->head)) {
		printf("list is null");
		return;
	}
	LinkNode *p = L->head;
	while (!IS_NULL(p)) {
		visit_func(p->value);
		p = p->next;
	}
}
