/* 
* @Author: Hector
* @Date:   2015-03-26 14:48:32
* @Last Modified by:   Hector
* @Last Modified time: 2015-03-27 12:51:31
*/
class Solution {
public:
	void swap(int arr[], int a, int b) {
		int temp = arr[a];
		arr[a] = arr[b];
		arr[b] = temp;
	}

	void reverse(int arr[], int begin, int end)
	{
		int mid = (begin + end) / 2;
		for (int i = begin, j = 0; i < mid; i++, ++j) {
			swap(arr, i, end - j - 1);
		}
	}

	void rotate(int nums[], int n, int k)
	{
		if (k >= n) k %= n;
		reverse(nums, 0, n - k);
		reverse(nums, n - k, n);
		reverse(nums, 0, n);
	}
};