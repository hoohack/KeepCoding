class Solution {
public:
    bool containsNearbyDuplicate(vector<int>& nums, int k) {
    	int len = nums.size();
    	if (k < 0 || len < 0)
    	{
    		return false;
    	}
    	
    	set<int> s;
        for (int i = 0; i < len; ++i)
        {
        	if (s.size() > k)
        	{
        		s.erase(nums[i - k - 1]);
        	}
        	if (s.find(nums[i]) != s.end())
        	{
        		return true;
        	}
        	s.insert(nums[i]);
        }

        return false;
    }
};