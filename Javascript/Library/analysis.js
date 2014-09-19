//编写一个javascript函数将URL解析为一个结构与页面中的javascript location的对象相似的对象实体。
//如：输入url串为'http://www.qq.com/index.html?key1=1&key2=2&key3=3'
//最后输出
// {
// 	'protocol' : 'http:',
// 	'hostname' : 'www.qq.com',
// 	'pathname' : 'index.html',
// 	'query' : 'key1=1&key2=2&key3=3'
// }

function analyzeURL(url) {
	var protocol = '',
		hostname = '',
		pathname = '',
		query = '',
		regx = /\/\//,
		protocolIndex = url.match(regx)['index'];
	protocol = url.substr(0, protocolIndex);

	var restUrl = url.substr(protocolIndex+2);
	var dsIndex = restUrl.indexOf('/');
	hostname = restUrl.substr(0, dsIndex);
	var questionIndex = restUrl.indexOf('?');
	pathname = restUrl.substr(dsIndex+1, questionIndex - dsIndex - 1);
	query = questionIndex != -1 ? restUrl.substr(questionIndex+1) : '';

	return {
		'protocol' : protocol,
		'hostname' : hostname,
		'pathname' : pathname,
		'query' : query
	};
}

var url = 'http://www.qq.com/index.html?key1=1&key2=2&key3=3';
var url2 = "http://example.com/aa/bb/";
var locationObj = analyzeURL(url);
console.log(locationObj);
locationObj = analyzeURL(url2);
console.log(locationObj);