//Given a sorted integer array without duplicates, return the summary of its ranges.
//For example, given [0,1,2,4,5,7], return ["0->2","4->5","7"].
class Solution {
public:
    vector<string> summaryRanges(vector<int>& nums) {
        vector<string> tmp_vec;
    	tmp_vec.reserve(nums.size());
    	int cur_begin = 0,
    		count = 0;
    	for (int i = 0; i < nums.size(); ++i)
    	{
    		count = 0;
    		cur_begin = nums[i];
    		while (1 && i < (nums.size() - 1))
    		{
    			if ((nums[i+1] - nums[i]) == 1)
    			{
    				++count;
    				++i;
    				continue;
    			}
    			else
    			{
    				break;
    			}
    		}
    		string begin = to_string(cur_begin);
    		if (count == 0)
    		{
    			tmp_vec.push_back(begin);
    		}
    		else
    		{
    			tmp_vec.push_back(begin.append("->").append(to_string(nums[i])));
    		}
    	}
    	return tmp_vec;
    }
};
