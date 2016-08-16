#include "bstree.h"
#include "common.h"
#include <stdlib.h>
#include <stdio.h>

int main()
{
	BSTree *t = create_tree();
	int arr[10] = {6, 4, 2, 5, 7, 9, 8, 10, 3, 1};
	int i = 0;
	int *data = NULL;
	for (i = 0; i < 10; i++) {
		data = (int *)malloc(sizeof(int));
		*data = arr[i];
		tree_insert(t, data);
	}

	printf("pre order traverse: \n");
	pre_order_traverse(t->root);
	printf("--------------------\n");
	printf("in order traverse: \n");
	in_order_traverse(t->root);
	printf("--------------------\n");
	printf("post order traverse: \n");
	post_order_traverse(t->root);
	printf("--------------------\n");
	data = (int *)malloc(sizeof(int));
	*data = 4;
	printf("delete element 4\n");
	tree_delete(t, data);
	printf("post order traverse: \n");

	post_order_traverse(t->root);
	printf("--------------------\n");
	pre_order_traverse(t->root);
	printf("--------------------\n");
	in_order_traverse(t->root);
	return 0;
}
