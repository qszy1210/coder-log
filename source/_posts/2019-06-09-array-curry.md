---
title: 2019-06-09-array-curry
date: 2019-06-09 17:47:33
tags: curry call arguments
categories: "javascript"
---

## array curry

将一个方法进行curry(颗粒化), 即比如一个方法接受三个参数, 那么现在通过调用三次的方式进行实现

例如

```js
function test(a, b, c) {
    return a+b+c;
}

//正常调用
test(1,2,3); //6

testCurry(1)(2)(3);//6
```

有一个方法, 比如 curry, 进行以下执行

> 主要实现思路是将参数一次一次通过闭包进行记录, 然后通过比较最终调用原处的方法

```js
const testCurry = curry(test);

function curry(fn, ...arg) {
    const len = fn.length;
    if (arg.length >= len) {
        return fn.call(null, ...arg);
    }
    return function(...arg2) {
        return curry(fn, ...arg2, ...arg);
    }
}

function curryWithArgument(fn) {
    const len = fn.length;
    const arg = Array.prototype.slice.call(arguments, 1);
    if (arg.length >= len) {
        return fn.call(null, ...arg);
    }
    return function() {
        const arg2 = arguments;
        return curry(fn, ...arg2, ...arg);
    }
}

```

