/* 
* @Author: Hector
* @Date:   2015-07-27 16:12:09
* @Last Modified by:   huhuaquan
* @Last Modified time: 2015-07-27 16:15:31
*/

'use strict';

//获取一个字符串的字节长度
//一个中文字符占用一个字节，一个中文字符占用2个字节
function getBytes(str) {
	var len = str.length,
		bytes = len;
	for (var i = 0; i < len; ++i)
	{
		if (str.charCodeAt(i) > 255) bytes++;
	}

	return bytes;
}