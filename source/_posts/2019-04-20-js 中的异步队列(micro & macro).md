---
title: js 队列
date:  2019-04-20
tags: microtask 队列
categories: "2019-04"
---

# js 中的异步队列(micro & macro)

js都是靠事件驱动的, js中的事件循环机制是什么呢?

> 只是简单写一下自己的理解, 所以不是很全面;

js 程序执行有 主队列 以及 异步队列两种方式

栈中是按照顺序进行执行, 对于一段代码的解释, 按照不同的类型进行解释,
入栈, 然后按照栈的顺序(后进先出)依次进行执行

主队列, 即从上到下的方式依次进行执行

异步队列主要包括macroTask 和 macroTask

1. macroTask, 主要包括 setTimeout setInterval IO UIRendering(只列举常用的)

2. microTask , 主要包括 Promise process

**主线程执行完成后, 会首先查看 microTask 队列中是否有, 执行完成后, 再执行 macroTask**

例如如下我的测试代码

```js
console.log("1")
setTimeout(function () {
    console.log("2")
})
Promise.resolve().then(function () {
    console.log("3")
    setTimeout(function () {
        console.log("31")
        setTimeout(function () {
            console.log("311")
        })
        Promise.resolve().then(function () {
            console.log("3111")
        })
    })
}).then(function () {
    console.log("4")
})
setTimeout(function () {
    console.log("5")
    Promise.resolve().then(function () {
        console.log("51")
    })
})
console.log("11")

//输出如下: 1 11 3 4 2 5 51 31 3111 311
//macro [2, 5]  [31]
//micro [3, 4]  [51]
```
需要注意的地方:

microTask会阻碍页面的 render, render 是属于 macroTask;

所以如果有 microTask 一直循环执行的话, 会阻碍 ui 的 render;

但是 setTimeout 不会;

另外要注意 rAF 的使用, 这个是用来专门进行渲染使用的, 执行速度会
比 setTimeout 少很多.



