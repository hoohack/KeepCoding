/* 
* @Author: Hector
* @Date:   2015-03-27 09:28:08
* @Last Modified by:   Hector
* @Last Modified time: 2015-04-02 18:28:24
*/
class Solution {
public:
    int trailingZeroes(int n) {
    	int result = 0;  
	   	int baseNum = 5;  
		while (n >= baseNum)  
		{  
		    result += n/baseNum;  
		 	baseNum *= 5;  
		}  
		return result;
    }
};