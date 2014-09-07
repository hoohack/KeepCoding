//Duff策略
//Duff策略的主要原理是通过展开循环减少次数来提高效率。
//Duff由Tom Duff发明的，是一种在不知道循环次数的情况下执行循环的方式。
//Duff策略是DO语句与SWITCH语句的结合。还需要注意到的是它把展开循环，反转循环次数和翻转循环结合在一次。
//下面是一个实现Duff策略的javascript示例

var iterations = 21;            //总循环次数
var n = iterations / 8;         //循环轮数
var caseTest = iterations % 8;  //额外余量

do {
    switch (caseTest) {
        case 0:              test();
        case 7:              test();
        case 6:              test();
        case 5:              test();
        case 4:              test();
        case 3:              test();
        case 2:              test();
        case 1:              test();
    }
    caseTest=0;
}while (--n > 0);

//工作原理：
//caseTest是额外余量
//n是循环轮数
//在本个示例中，很明显caseTest等于5,n等于2。当第一次进入do语句时，caseTest等于5。所以它跳到
//case5的地方。此时case 5的语句开始执行，然后会一直执行下面的case语句直到遇到break语句为止。
//本示例有5个额外余量，但是通过跳转到case 5语句，我们执行了该次数的程序语句。在经过第一次的“循环”
//之后，把caseTest设置为0，因此我们可以回到“循环”的顶部，然后每一个case的程序语句都会被执行一次。
//这就是我们想要的，因为我们只有8次需要执行。总共有多少组呢？当然是n！而且我们在每次循环的底部都将n
//递减。然后程序就会循环n次，这样子我们就能总共执行iterations次了。注意我们用的是前置运算符自减，这合乎情理。

function test() {
    console.log("test");
}