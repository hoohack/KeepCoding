class Solution {
public:
    bool isPowerOfTwo(int n) {
        if (n == 1) 
    	{
    		return true;
    	}
    	if (n <= 0 || (n%2) != 0)
    	{
    		return false;
    	}
    	int left = 0;
    	while (n && (left == 0))
    	{
    		left = n % 2;
    		n /= 2;
    	}
    	if (n == 0)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
};
