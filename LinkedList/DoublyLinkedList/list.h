#ifndef LIST_H
#define LIST_H
#include <stdlib.h>
#include <stdio.h>
#include <string.h>

typedef int (*visit_func)(void *);
typedef struct ListNode ListNode;
typedef struct List List;

#define IS_NULL(x) ((x) == NULL)

List *list_create(int (*compare)(const void *, const void *));
void list_insert(List *L, void *value);
void *list_delete(List *L, const void *value);
ListNode *list_search(const List *L, const void *value);
size_t list_length(const List *L);
void list_traversal(List *L, void (*visit_func)(void *));
void list_retraversal(List *L, void (*visit_func)(void *));

#endif
