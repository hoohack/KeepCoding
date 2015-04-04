/* 
* @Author: Hector
* @Date:   2015-04-04 12:46:39
* @Last Modified by:   Hector
* @Last Modified time: 2015-04-04 17:23:51
*/

class Solution {
public:
    int titleToNumber(string s) {
        int total = 0, temp = 0;
		int len = s.length();

	   	for (int j = 0; j < len; ++j)
	   	{
	   		temp = s[j] - 'A' + 1;
	   		total = total * 26 + temp;
	   	}
	   	return total;       		
    }
};