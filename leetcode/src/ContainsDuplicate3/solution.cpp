class Solution {
public:
    bool containsNearbyAlmostDuplicate(vector<int>& nums, int k, int t) {
        if (k < 1 || t < 0)
    	{
    		return false;
		}
    	
        int len = nums.size();
    	unordered_map<int, long long> nums_map;
    	queue<int> keys;
    	
        for (int i = 0; i < len; ++i)
        {
        	int key = nums[i] / max(t, 1);
        	for (int j = key - 1; j <= key + 1; ++j)
        	{
        		if (nums_map.find(j) != nums_map.end() && abs(nums_map[j] - nums[i]) <= (long long) t)
        		{
        			return true;
				}
			}
			nums_map[key]=nums[i];  
            keys.push(key);  
            if(nums_map.size() > k)
			{  
                nums_map.erase(keys.front());  
                keys.pop();  
            }  
        }

        return false;
    }
};