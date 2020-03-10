---
title: asyncify方法
tags: async javascript
date: 2020-02-20 10:12:39
---



## 将一个函数变为异步执行的方法的探讨

### 1. 分析

 接收一个函数， 并将这个函数作为异步进行执行。
 需要将这个函数加入另外一个队列进行执行，首先想到的是 setTimeout 或者 promise

 返回一个函数

**调用的时候才刚开始安排 setTimeout， 实际执行会在更靠后。**

```js
 function asyncify(fn) {
     return function(..args) {
         setTimeout(fn.bind(this), 0);
     }
 }
```


### 另一个思路， 通过 setTimeout ， 进行判断是否在 timeout 执行之后

保证当前方法的执行时在 setTimeout 之后进行。

**提前安排 setTimeout， 尽量的提前， 但是要是异步执行。**

```js
function asyncify(fn) {
    let old_fn = fn;
    let clr = setTimeout(function(){
        clearTimeout(clr);
        if (fn) fn()
    }, 0);

    fn = null;

    return function(...args){
        if (clr) {
            //说明 setTimeout 还没有执行， 给 fn 赋值， setTimeout 中会去执行
            fn = old_fn.bind.apply(old_fn, [this].concat(args));
        }
        else {
            //说明 setTimeout 已经执行了， 这个时机在 setTimeout 之后了
            //（因为你获取的是一个方法句柄， 具体什么时候执行是看调用的）
            old_fn.apply(this, args);
        }
    }
}
```

