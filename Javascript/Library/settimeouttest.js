// 现有代码如下：
function test() {
        var a = 1;
        setTimeout(function() {
                alert(a);
                a = 3;
        }, 1000);
        a = 2;
        setTimeout(function() {
                alert(a);
                a = 4;
        }, 3000);
}
 
test();
alert(0);

// 请注意,代码中有三处alert.他们分别会alert出什么值，时间上的顺序是怎样的？
// 请详述得到这个答案的原因，特别是test函数的局部变量a是对运行结果的影响。

//解答如下：
//分别会弹出2,3,0，而时间上的顺序是弹出0，2，3。
//因为setTimeout会设置定时器将代码延迟执行，第一个setTimeout里面的函数会在执行了test后1秒执行，
//第二个setTimeout里面的函数会在执行了test后3秒执行，而alert(0)会在执行了test后马上执行，所以先弹出0。
//test执行1秒后a=2,所以alert(a)弹出2,然后将a赋值为3.所以2秒后alert(a)为3。