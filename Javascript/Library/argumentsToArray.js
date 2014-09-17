// arguments是数组么?如果不是请写一段代码将其转化为真正的数组

function toArray() {
	try {
		return Array.prototype.slice.call(arguments, 0);
	} catch(e) {
		var newArr = [];
		for (var i = 0, len = arguments.length; i < len; i++) {
			newArr[i] = arguments[i];
		}

		return newArr;
	}
}

//slice([begin[, end]]) 从已有的数组中返回选定的元素，返回的是一个新数组。
//fun.call(thisArg[, arg1[, arg2[, ...]]]) 在使用一个指定的this值和若干指定的参数值的前提下调用某个函数和方法
//注：通过call方法，可在一个对象上借用另一个对象上的方法。所以上面的Array.prototype.slice.call(arguments, 0)
//可以简单地理解成是arguments对象借用了Array的slice方法。
//使用Array.prototype的原因：一个类凡是通过prototype的属性和方法，都可以在这个类的对象里找到对象。
//Array.prototype.slice这句是访问Array的内置方法
//因为Array是类名，而不是对象名，所以不能直接使用Array.slice