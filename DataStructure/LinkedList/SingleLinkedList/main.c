#include "list.h"

void visit(void *value) { printf("*%d* ", *(int *)value); }

int cmp(void *const a, void *const b)
{
	int *val1 = (int *)a;
	int *val2 = (int *)b;

	return (*val1 > *val2) - (*val1 < *val2);
}

int main()
{
	List *L = list_create(&cmp);
	int num = 10;
	int i = 0;
	int *key = NULL;
	for (i = 0; i < num; i++) {
		key = malloc(sizeof(int));
		*key = i;
		list_insert(L, key);
	}
	list_traversal(L, visit);
	printf("\n");
	key = malloc(sizeof(int));
	*key = 0;
	list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	key = malloc(sizeof(int));
	*key = 1;
	list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	key = malloc(sizeof(int));
	*key = 1;
	list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	key = malloc(sizeof(int));
	*key = 5;
	list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	key = malloc(sizeof(int));
	*key = 9;
	list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	key = malloc(sizeof(int));
	*key = 8;
	list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	return 0;
}
