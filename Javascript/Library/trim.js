function trim(text) {
	//删除头部的空白
	text = text.replace(/^\s+/, "");

	//清除尾部的空白
	for (var i = text.length - 1; i >= 0; i--) {
		//当遇到非空白字符时清楚尾部空白后退出循环
		if (/\S/.test(text.charAt(i))) {
			text = text.substring(0, i + 1);
			break;
		}
	}

	return text;
}