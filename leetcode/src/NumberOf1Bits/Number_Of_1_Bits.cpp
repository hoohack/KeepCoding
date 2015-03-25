/* 
* @Author: Hector
* @Date:   2015-03-25 09:33:05
* @Last Modified by:   Hector
* @Last Modified time: 2015-03-25 18:53:41
*/
class Solution {
public:
    int hammingWeight(uint32_t n) {
        int num = 0;
        while (n > 0) {
            if ((n & 1) == 1)
                ++num;
            n >>= 1;
        }
        return num;
    }
};