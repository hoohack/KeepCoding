/* 
* @Author: Hector
* @Date:   2015-03-26 10:33:55
* @Last Modified by:   Hector
* @Last Modified time: 2015-03-26 14:25:40
*/

class Solution {
public:
	int gcd(int m, int n) {
		if (m % n == 0)
	    {
	        return n;
	    }
	    else
	    {
	        return gcd(n, m%n);
	    }
	}

	void rotate(int nums[], int n, int k)
	{
		if (k > n) {
			k %= n;
		}
		if (k % n == 0) return;
	    int count = gcd(n, k);
		for(int j = 0; j < count;j++) {
			int temp = nums[n - j - 1];
			int current = n - j - 1;
			int previous = (current - k) % n;
			for (;previous != n - j - 1;previous = (previous - k + n) % n) {
			    nums[current] = nums[previous];
			    current = previous;
			}
			previous = (previous + k) % n;
			nums[previous] = temp;
		}
	}
};