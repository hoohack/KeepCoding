class Solution {
public:
    TreeNode* invertTree(TreeNode* root) {
        if (!root)
    	{
    		return NULL;
    	}
    	TreeNode *left = root->left;
    	TreeNode *right = root->right;
    	root->right = invertTree(left);
    	root->left = invertTree(right);
    	return root;
    }
};
