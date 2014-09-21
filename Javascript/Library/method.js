//扩展Function对象，为Function对象，添加method方法，参数1是函数名字，参数2是添加的函数体
//如此做之后，再为javascript的基本类型添加方法就不用键入prototype这个关键字。
Function.prototype.method = function(name,func) {
    if (!this.prototype[name]){
        this.prototype[name] = func;
    }
    return this;
}

//e.g:
//为Number对象扩展方法integer
Number.method('integer',function() {
    //number小于0，采用Math.ceil,大于Math.floor,调用方法，传入的实参this即number本身
    return Math[this < 0 ? 'ceil' : 'floor'](this);
})
