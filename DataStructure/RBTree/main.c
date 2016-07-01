#include "rbtree.h"
#include <stdlib.h>
#include <stdio.h>

#define TOTAL 20

int rbt_cmp(void *_val1, void *_val2)
{
	int *val1 = (int *)_val1;
	int *val2 = (int *)_val2;

	return (*val1 > *val2) - (*val1 < *val2);
}

int main(int argc, char *argv[])
{
	int arr[TOTAL] = {12, 6,  25, 10, 3,  18, 55, 11, 7,  4,
			  2,  15, 21, 33, 98, 9,  13, 16, 20, 22};
	int i = 0;
	RBTree *tree = rbtree_init(&rbt_cmp);
	int *key = NULL;

	int *value = NULL;
	for (i = 0; i < TOTAL; i++) {
		key = malloc(sizeof(int));
		*key = arr[i];
		value = malloc(sizeof(int));
		*value = arr[i];
		rbtree_insert(tree, key, value);
	}
	printf("insert finished \n");
	rbtree_preorder(tree->root);
	key = malloc(sizeof(int));
	*key = 12;
	key = rbtree_del(tree, key);
	printf("----delete %d finished----\n\n", *(int *)key);
	rbtree_preorder(tree->root);

	return 0;
}
