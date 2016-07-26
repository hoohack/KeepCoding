#include "list.h"

void visit(void *value) { printf("%d ", *(int *)value); }

int cmp(const void *a, const void *b)
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
	list_retraversal(L, visit);
	printf("\n");
	key = malloc(sizeof(int));
	*key = 2;
	key = list_delete(L, key);
	list_traversal(L, visit);
	printf("\n");

	return 0;
}
