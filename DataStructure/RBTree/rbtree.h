#ifndef RBTREE_H
#define RBTREE_H

#define RED 1
#define BLACK 0

#define LEFT 1
#define RIGHT 2

#define IS_NULL(node) ((node) == NULL)
#define IS_RED(node) ((node) != NULL && (node)->color == RED)

struct RBNode {
	struct RBNode *parent;
	void *key;
	void *value;
	struct RBNode *left;
	struct RBNode *right;
	int color;
};

typedef struct RBTree {
	struct RBNode *root;
	int (*rbt_keycmp)(void *, void *);
} RBTree;

RBTree *rbtree_init(int (*rbt_keycmp)(void *, void *));
void rbtree_insert(RBTree *tree, void *key, void *value);
void *rbtree_del(RBTree *tree, void *key);
void rbtree_preorder(struct RBNode *node);
void rbtree_inorder(struct RBNode *node);
void rbtree_postorder(struct RBNode *node);

#endif
