/* 
* @Author: Hector
* @Date:   2015-03-25 18:59:02
* @Last Modified by:   Hector
* @Last Modified time: 2015-03-26 10:03:03
*/
class Solution {
public:
    void rotate(int nums[], int n, int k) {
    	if (k >= n) {
			k = k % n;
		}

		int *p = new int[k];
		for (int i = 0; i < k; ++i) {
			p[i] = nums[n - k + i];
		}
		for (int j = 0; j < n - k; ++j) {
			nums[n - j - 1] = nums[n - k - j - 1];
		}
		for (int i = 0; i < k; ++i) {
			nums[i] = p[i];
		}
    }
};