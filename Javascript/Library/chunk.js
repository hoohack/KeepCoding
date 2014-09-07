/**
* @param array 		需要处理的数组
* @param process 	用来处理每个数组元素的函数
* @param context	(可选)用来设置处理函数执行时的上下文(默认所有传入setTimeout方法的函数都在全局上下文中运行，所以this为window)
*/
function chunk(array, process, context) {
	setTimeout(function run() {
		var item = array.shift();
		process.call(context, item);

		if (array.length > 0) {
			setTimeout(run, 100);
		}
	}, 100);
}

var names = ["Nicholas", "Steve", "Doug", "Bill", "Ben", "Dion"],
	todo = names.concat();

	chunk(todo, function(item) {
		console.log(item);
	});