/* 
* @Author: Hector
* @Date:   2015-03-25 18:03:28
* @Last Modified by:   Hector
* @Last Modified time: 2015-03-25 18:52:43
*/
class Solution {
public:
    uint32_t reverseBits(uint32_t n) {
    	char table[16] = {0, 8, 4, 12, 2, 10, 6, 14, 1, 9, 5, 13, 3, 11, 7, 15};
        int current = 0;
        uint32_t result = 0;
        uint32_t flag = 0xF;

        for (int i = 0; i < 8; i++) {
        	result <<= 4;
        	current = flag & n;
        	result |= table[current];
        	n >>= 4;
        }

        return result;
    }
};