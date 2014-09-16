//请写一个 getParents 方法让它可以获取某一个 DOM 元素的所有父亲节点
function getParents(ele) {
    var matched = [];
    // 防止获取 document
    //document的nodeType=9
    while ( (ele = ele.parentNode) && ele.nodeType !== 9) {
        matched.push(ele)
    }
    return matched
}
