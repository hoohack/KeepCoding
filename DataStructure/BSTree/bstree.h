#ifndef _BSTREE_H
#define _BSTREE_H

#include <stdbool.h>

#define SUCCESS 1
#define FAILED 0
#define INIT_SIZE 20

#define BSTREE_API

#define INT_VAL(v) *((int *)(v))

typedef struct _bstree_node
{
	void* value;
	struct _bstree_node* left;
	struct _bstree_node* right;
	struct _bstree_node* parent;
} BSTreeNode;

typedef struct _BSTree
{
	BSTreeNode* root;
	int size;
	int curr_size;
} BSTree;

BSTREE_API BSTree* create_tree();
BSTREE_API int tree_insert(BSTree* t, void* value);
BSTREE_API int tree_delete(BSTree* t, void* value);
BSTREE_API BSTreeNode* tree_maxium(BSTree *t);
BSTREE_API BSTreeNode* tree_minium(BSTree *t);
BSTREE_API bool is_empty(const BSTree* t);
BSTREE_API bool is_full(const BSTree* t);
BSTREE_API void pre_order_traverse(const BSTreeNode* root);
BSTREE_API void in_order_traverse(const BSTreeNode* root);
BSTREE_API void post_order_traverse(const BSTreeNode* root);

#endif
