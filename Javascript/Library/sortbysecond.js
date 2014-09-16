// 有一个数组，其中保存的都是小写英文字符串，现在要把它按照除了第一个字母外的字符的字典顺序(字典顺序就是按首字母从a-z顺序排列，如果首字母相同则按第二个字母……)排序，请编写代码

// 例：["abd","cba","ba",]，排序后["ba","cba","abd"]

var sortbysecond = function (x, y) {
	if (typeof x === 'string' && typeof y === 'string') {
		var a = x.slice(1);
		var b = y.slice(1);
	
		if(a > b) {
			return 1;
		} else {
			return -1;
		}
	}

	return 0;
}

// var arr = ["abd","cba","ba"];
// arr.sort(sortbysecond);