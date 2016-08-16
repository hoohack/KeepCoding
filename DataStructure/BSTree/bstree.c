#include "bstree.h"
#include "common.h"
#include <stdlib.h>
#include <stdio.h>

/**
 * 初始化树
 */
BSTREE_API BSTree *create_tree()
{
	BSTree *bst = (BSTree *)malloc(sizeof(BSTree));
	if (bst == NULL)
		return NULL;
	bst->root = NULL;
	bst->size = INIT_SIZE;

	return bst;
}

BSTREE_API BSTreeNode *tree_maximum(BSTreeNode *node)
{
	BSTreeNode *max = node;
	while (max->right != NULL) {
		max = max->right;
	}

	return max;
}

BSTREE_API BSTreeNode *tree_minimum(BSTreeNode *node)
{
	BSTreeNode *min = node;
	while (min->left != NULL) {
		min = min->left;
	}

	return min;
}

void _do_insert(BSTree *t, BSTreeNode *new_node)
{
	BSTreeNode *current = t->root;
	BSTreeNode *insert_parent = NULL;

	while (current != NULL) {
		insert_parent = current;
		if (INT_VAL(new_node->value) > INT_VAL(current->value)) {
			current = current->right;
		} else {
			current = current->left;
		}
	}

	new_node->parent = insert_parent;
	if (insert_parent == NULL) {
		t->root = new_node;
	} else if (INT_VAL(new_node->value) < INT_VAL(insert_parent->value)) {
		insert_parent->left = new_node;
	} else {
		insert_parent->right = new_node;
	}
}

/**
 * 插入结点到树
 */
BSTREE_API int tree_insert(BSTree *t, void *value)
{
	BSTreeNode *new_node = (BSTreeNode *)malloc(sizeof(BSTreeNode));
	if (new_node == NULL)
		return FAILED;

	new_node->value = value;

	_do_insert(t, new_node);
	t->curr_size++;

	return SUCCESS;
}

inline static void TREE_TRANSPLANT(BSTree *t, BSTreeNode *old, BSTreeNode *new)
{
	if (old->parent == NULL) {
		t->root = new;
	} else if (old == old->parent->left) {
		old->parent->left = new;
	} else {
		old->parent->right = new;
	}

	if (new != NULL)
		new->parent = old->parent;
}

void _do_delete(BSTree *t, BSTreeNode *node)
{
	BSTreeNode *successor = NULL;

	if (node->left == NULL) {
		TREE_TRANSPLANT(t, node, node->right);
	} else if (node->right == NULL) {
		TREE_TRANSPLANT(t, node, node->left);
	} else {
		successor = tree_minimum(node->right);
		if (successor->parent != node) {
			TREE_TRANSPLANT(t, successor, successor->right);
			successor->right = node->right;
			successor->right->parent = successor;
		}

		TREE_TRANSPLANT(t, node, successor);
		successor->left = node->left;
		successor->left->parent = successor;
	}
}

/**
 * 删除结点
 */
BSTREE_API int tree_delete(BSTree *t, void *value)
{
	BSTreeNode *root = t->root;
	if (root == NULL)
		return FAILED;

	BSTreeNode *current = root;
	BSTreeNode *previous = NULL;
	while (current) {
		if (INT_VAL(value) == INT_VAL(current->value))
			break;
		previous = current;
		if (INT_VAL(value) > INT_VAL(current->value))
			current = current->right;
		else
			current = current->left;
	}

	if (current == NULL) {
		return FAILED;
	} else {
		_do_delete(t, current);
		return SUCCESS;
	}
}

/**
 * 前序遍历
 */
void pre_order_traverse(const BSTreeNode *root)
{
	if (root == NULL)
		return;
	print_node(root->value);
	pre_order_traverse(root->left);
	pre_order_traverse(root->right);
}

/**
 * 中序遍历
 */
void in_order_traverse(const BSTreeNode *root)
{
	if (root == NULL)
		return;
	in_order_traverse(root->left);
	print_node(root->value);
	in_order_traverse(root->right);
}

/**
 * 后序遍历
 */
void post_order_traverse(const BSTreeNode *root)
{
	if (root == NULL)
		return;
	post_order_traverse(root->left);
	post_order_traverse(root->right);
	print_node(root->value);
}

/**
 * 判断树是否为空
 */
BSTREE_API bool is_empty(const BSTree *bst) { return bst->curr_size == 0; }

/**
 * 判断树是否已满
 */
BSTREE_API bool is_full(const BSTree *bst)
{
	return bst->curr_size == bst->size;
}
