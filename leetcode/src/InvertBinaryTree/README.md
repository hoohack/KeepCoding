//Invert a binary tree.
//     4
//   /   \
//  2     7
// / \   / \
//1   3 6   9

//     4
//   /   \
//  7     2
// / \   / \
//9   6 3   1

/**
 * Definition for a binary tree node.
 * struct TreeNode {
 *     int val;
 *     TreeNode *left;
 *     TreeNode *right;
 *     TreeNode(int x) : val(x), left(NULL), right(NULL) {}
 * };
 */

 这道题采用的方法是递归，递归地翻转二叉树