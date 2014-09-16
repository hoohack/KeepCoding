// 写一段脚本，实现：当页面上任意一个链接被点击的时候，alert出这个链接在页面上的顺序号，如第一个链接则alert(1), 依次类推。
//主要考察闭包
(function () {
	var links = document.links,
		links_len = document.links.length;
	for (var i = 0; i < links_len; i++) {
		(function(arg) {
			links[arg].onclick = function() {
				console.log(arg+1);
			};
		})(i);
	}
})();