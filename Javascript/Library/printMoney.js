//给定字符串，输出国际数字格式，如1234567，输出1,234,567

function printMoney(number) {
	if (typeof number !== 'number') {
		throw 'Not Number';
	}
	else
	{
		var number_str = number.toString(),
			len = number_str.length,
			temp_arr = [];
		for (var i = len; i > 3; i-= 3) {
			temp_arr.unshift(number_str.slice(i-3, i));
		}
	}
	if (i > 0)
	{
		temp_arr.unshift(number_str.slice(0, i));
	}
	return temp_arr.join(',');
}

var result = printMoney(1234567);
console.log(result);