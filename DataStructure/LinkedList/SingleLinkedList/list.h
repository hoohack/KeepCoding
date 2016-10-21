#ifndef _LinkedList_H
#define _LinkedList_H

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define LinkedListAPI
#define IS_NULL(x) ((x) == NULL)

typedef int (*visit_func)(void *);
typedef struct LinkNode LinkNode;
typedef struct List List;

LinkedListAPI List *list_create(int (*compare)(void *const, void *const));
LinkedListAPI void list_insert(List *L, void *const);
LinkedListAPI void list_delete(List *L, void *const value);
LinkedListAPI size_t list_length(const List *L);
LinkedListAPI void list_traversal(List *const L, void (*visit_func)(void * const));

#endif /* _LinkedList_H */
