function RepeatTimer() {
	var interval = 3000;
	setTimeout(function(){
		//EventCall
    	setTimeout(arguments.callee, interval);
    }, interval);
}

//该函数链式调用了setTimeout，每次函数执行的时候都会创建一个新的定时器。第二个setTimeout()调
//用使用了argument.callee来获取对当前执行的函数的引用，并为其设置另外一个定时器。这样的好处是
//，在前一个定时器代码执行完之前，不会向队列插入新的定时器代码，确保不会有缺失的问题。而且，它可
//以保证在下一次定时器代码执行之前，至少等待指定的间隔，避免了连续的运行。这个模式主要用于重复定
//时器。