Function.prototype.method = function(name, func) {
	if (!this.prototype[name]){
        this.prototype[name] = func;
    }
    return this;
}

//pop
Array.method('pop', function() {
	return this.splice(this.length - 1, 1)[0];
});

//push
Array.method('apush', function() {
	this.splice.apply(this, [this.length, 0].concat(Array.prototype.slice.apply(arguments)));
	return this.length;
});

//shift
Array.method('shift', function() {
	return this.splice(0, 1)[0];
});

//splice
Array.method('splice', function(start, deleteCount) {
	var max = Math.max,//最大值函数
		min = Math.min,//最小值函数
		delta,//实际新增元素数量
		element,
		insertCount = max(argument.length - 2, 0),//插入元素数量
		k = 0,
		len = this.length,//原数组长度
		new_len,//操作结束后数组的长度
		result = [],//删除的元素
		shift_count;//要移动的元素的数量

	start = start || 0;
	if (start < 0) {
		start += len;
	}
	start = max(min(start, len), 0);
	deleteCount = max(min(typeof deleteCount === 'number' ? deleteCount : len, len - start), 0);
	delta = insertCount - deleteCount;
	new_len = len + delta;

	//保存被删除的元素到result数组中
	while (k < deleteCount) {
		element = this[start + k];
		if (element !== undefined) {
			result[k] = element;
		}
		++k;
	}

	//计算要移动的元素的数量
	shift_count = len - start - deleteCount;

	//调整删除元素后的数组
	if (delta < 0) {
		k = start + insertCount;
		while (shift_count) {
			this[k] = this[k - delta];
			++k;
			--shift_count;
		}
		this.length = new_len;
	} else if (delta > 0) {
		k = 1;
		while (shift_count) {
			this[new_len - k] = this[len - k];
			++k;
			--shift_count;
		}
	}

	//插入新元素
	for (k = 0; k < insertCount; ++k) {
		this[start + k] = arguments[k + 2];
	}

	return result;
});

//unshift
Array.method('unshift', function() {
	this.splice.apply(this, [0, 0].concat(Array.prototype.slice.apply(arguments)));
	return arguments;
});