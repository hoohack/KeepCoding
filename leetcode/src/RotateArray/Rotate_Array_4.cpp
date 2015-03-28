/* 
* @Author: Hector
* @Date:   2015-03-28 09:42:24
* @Last Modified by:   Hector
* @Last Modified time: 2015-03-28 09:44:56
*/

#include <iostream>

using namespace std;

void rotate(int nums[], int n, int k) {
    int cursor = 0;
    for (int i = 0; i < k; ++i) {
        cursor = nums[n - 1];
        for (int j = 0; j < n - 1; ++j) {
            nums[n-j-1] = nums[n-j-2];
        }
        nums[0] = cursor;
    }
}

int main()
{
	int arr[5] = {1, 2, 3, 4, 5};
	rotate(arr, 5, 2);
	int a = 0;
	for (int i = 0; i < 5; ++i)
	{
		cout << arr[i] << " ";
	}
	cin >> a;
    return 0;
}