// 当我们使用CSS3新属性，比如：box-shadow或者transition时，我们怎么检测浏览器是否支持这些属性？
// 请设计一个JavaScript函数，该函数接受一个CSS属性名作为参数，并返回一个boolean值，表明浏览器是否支持这个属性。
//  Step 1：

// 我们首先需要确定的一件事是，该如何调用这个函数。我们应该把事情想得简单一点。

 

// if ( supports('textShadow') ) {
//     document.documentElement.className += ' textShadow';
// }
// 这就是最终要调用的方法，当我们传入的CSS属性名到这个supports()函数时，他会返回一个boolean值，如果是true，我们就会加一个class在<html>上面，被这个class勾到的样式就会被执行。 

// Step2：

// 接下来我们准备构造这个supports()函数。

// var supports = (function() {

// })();
// 为什么我们不把这个supports 写成一个标准的function呢？原因是在这个方法执行之前需要做一系列准备的事情，而绝不可能每次调用这个function时反复的去做这些。所以，最好让supports 指向一个有返回值的自执行函数。

// Step3：

// 为了测试浏览器是否支持这个特殊的属性，我们需要创建一个虚拟的元素。这个元素不会被插入到DOM树种，他只是一个用来做测试的傀儡。

// var div = document.createElement('div');
// 这时你是否已经意识到了在使用CSS3属性时我们会使用一系列的前缀。

// -moz
// -webkit
// -o
// -ms
// -khtml
// 在javascript里，我们必须得去遍历它们，所以我们这它们放到一个数组里面，把这个数组起名叫做vendors。

 

// var div = document.createElement('div'),
// vendors = 'Khtml Ms O Moz Webkit'.split(' ');
 

// “使用split()函数把字符串转化为一个数组是一种懒惰的办法，但是他确实很高效”

//  接下来我们准备遍历这个数组。我们都是好孩子，所以要养成缓存数组长度的好习惯。

// var div = document.createElement('div'),
// vendors = 'Khtml Ms O Moz Webkit'.split(' '),
// len = vendors.length;
// 这就是前期要做的事情，不需要每次调用supports()时都再执行一遍。页面加载以后它只执行一次。

 

// return function(prop) {

// };
 

// “这个闭包的好处在于尽管supports()是一个有返回值的function，它仍然可以访问到div、vendors和len变量”

 

 

 

// Step4：

// 马上就测试一下：如果这个传入的属性是div的style中有的变量，我们就认为这个浏览器支持这个属性；所以返回true。

// return function(prop) {
//     if ( prop in div.style ) return true;
// };
// 仔细想一下，现在主流浏览器都直接支持text-shadow了，而不需要那个前缀。对于这些浏览器就没必要遍历那个前缀数组了，这就是为什么我们把这个检查过程放到第一行。

// Step5：

// 大家都习惯写CSS3的属性名字类似这样-moz-box-shadow，然而在firebug里面你去看style对象，你就会发现他被写成MozBoxShadow，像这样的，如果我们测试

// 'mozboxShadow' in div.style // false
// 返回false，这就说明这个值是大小写敏感的。

// 这就意味着我们传入boxShadow 到supports()中，将会失败。所以我们需要事先检查一下传入参数第一个首字母是不是小写的，这样我们就修复了这个问题。

 

 

 

// if(prop in div.style) return true;
//   prop = prop.replace(/^[a-z]/, function(val) {
//     return val.toUpperCase();
//   });
// };
 

// 正则表达式解决了这个问题，我们检查这个字符串的首字母是不是小写，如果是则转换成大写字母。

// Step6：

// 我们接下来需要遍历这个vendors数组。假如传入的是box-shadow，我们需要检测div的style对象中是否存在下面其中的一个。
// MozBoxShadow
// WebkitBoxShadow
// MsBoxShadow
// OBoxShadow
// KhtmlBoxShadow
// 如果存在，将会返回true，说明该浏览器支持boxshadows。

 

// 复制代码
// return function(prop) {
//   if ( prop in div.style ) return true;
//   prop = prop.replace(/^[a-z]/, function(val) {
//     return val.toUpperCase();
//   });
//   while(len--) {
//     if ( vendors[len] + prop in div.style ) {
//       return true;
//     }
//   }
// };
// 复制代码
 

// 在这里我们没有必要使用for来遍历这个数组，原因如下：

// 1. 数组元素的顺序不重要
// 2. while字符少，写的快
// 3. while相对for性能好一点点

// 不要被vendors[len] + prop搞晕，他只是简单地取代那些名字和他们的真实值：MozBoxShadow

// Step7：

// 但是，如果没有一个值匹配到呢？在这种情况下，浏览器似乎不支持这个属性，所以需要返回false。

 

// while(len--) {
//   if ( vendors[len] + prop in div.style ) {
//     return true;
//   }
// }
// return false;
 

// 我们测试一下text-stroke（只有webkit内核浏览器支持），如果通过的话就会在<html>上加一个class。

// Step8：

// 如果一个class名字恰好被勾上，我们在样式表中可以这么写：

// 复制代码
// /* fallback */
// h1 {
//   color: black;
// }
// /* text-stroke support */
// .textStroke h1 {
//   color: white;
//   -webkit-text-stroke: 2px black;
// }
// 复制代码
// 最终的源代码
var supports = (function() {
	var div = document.createElement('div'),
		venders = 'khtml Ms O Moz Webkit'.split(' '),
		ven_len = venders.length;

	return function(prop) {
		if( prop in div.style) {
			return true;
		}

		prop = prop.replace(/^[a-z]/, function(val) {
			return val.toUpperCase();
		});

		while(ven_len--) {
			if( (venders[ven_len] + prop) in div.style) {
				return true;
			}
		}

		return false;
	};
})();

if (supports('textShadow')) {
	document.documentElement.className += ' textShadow';
}

//参考自：http://www.cnblogs.com/tryao/p/3933409.html