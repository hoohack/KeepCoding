// 如何判断浏览器是IE还是火狐，用ajax实现。

// 　　要想通过Ajax来判断是ie浏览器还是firefox浏览器，就应该通过XMLHttpRequest 对象。

// 　　首先简单介绍一下这个对象：
// 　　　　(1)所有现代浏览器均支持 XMLHttpRequest 对象（IE5 和 IE6 使用 ActiveXObject）。
// 　　　　(2)所有现代浏览器（IE7+、Firefox、Chrome、Safari 以及 Opera）均内建 XMLHttpRequest 对象。
var xmlhttp;
if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
    alert("your brower is not IE ");
} else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    alert("your brower is IE ")
}