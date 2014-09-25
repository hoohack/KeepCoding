//给定字符串，输出国际数字格式，如1234567，输出1,234,567

function printMoney(number) {
	if (typeof number !== 'number') {
		throw 'Not Number';
	} else {
		var len = number.toString().length,
			temp_arr = [];
		for (var i = 0; i < len; i++) {
			temp_arr[i] = number.toString().substring(i, i + 1);
		}
		for (var i = len, j = 0; i > 0; i--, j++) {
			if (j > 0 && j % 3 === 0) {
				temp_arr.splice(i, 0, ',');
			}
		}
	}
	return temp_arr;
}

var result = printMoney(1234567);
console.log(result.join(''));