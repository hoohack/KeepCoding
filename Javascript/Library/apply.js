//apply() 方法可以在使用一个指定的 this 值和一个参数数组（或类数组对象）的前提下调用某个函数或方法。
//语法
//fun.apply(thisArg[, argsArray])
//参数解释
//thisArg
//	在 fun 函数运行时指定的 this 值。需要注意的是，指定的 this 值并不一定是该函数执行时真正的 this 值，如果这个函数处于非严格模式下，则指定为 null 或 undefined 时会自动指向全局对象（浏览器中就是window对象），同时值为原始值（数字，字符串，布尔值）的 this 会指向该原始值的自动包装对象。
//argsArray
//	一个数组或者类数组对象，其中的数组元素将作为单独的参数传给 fun 函数。如果该参数的值为null 或 undefined，则表示不需要传入任何参数。
//在调用一个存在的函数时，你可以为其指定一个 this 对象。 this 指当前对象，也就是正在调用这个函数的对象。 使用 apply， 你可以只写一次这个方法然后在另一个对象中继承它，而不用在新对象中重复写该方法。
//Math.max 可以实现得到数组中最大的一项
//因为Math.max 参数里面不支持Math.max([param1,param2]) 也就是数组
//但是它支持Math.max(param1,param2,param3…),所以可以根据刚才apply的那个特点来解决 var max=Math.max.apply(null,array),这样轻易的可以得到一个数组中最大的一项(apply会将一个数组装换为一个参数接一个参数的传递给方法)
//这块在调用的时候第一个参数给了一个null,这个是因为没有对象去调用这个方法,我只需要用这个方法帮我运算,得到返回的结果就行,.所以直接传递了一个null过去
//Math.min  可以实现得到数组中最小的一项
//同样和 max是一个思想 var min=Math.min.apply(null,array);
var arr = [1, 2, 3, 4, 5, 6, 7];
console.log(Math.max.apply(null, arr));//输出7
