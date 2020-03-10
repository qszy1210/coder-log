---
title: function-TDZ
tags: tdz es6
date: 2020-03-02 14:21:04
---


### es6 方法中的暂时性死区介绍

比如以下的代码:

```js
let x = 4;
function test(x = x + 1){
 console.log(x)
}

test(5) // log 5
test(null) // log null
test() // error !!!
```

第三种情况会报错, 是因为什么原因呢?

这个时候因为参数没有传递, 会执行默认的 `x+1`, 但是 编译器发现前边有一个 x 是未初始化的,
未初始化是不允许使用的, 所以这个时候就报错了, 提示 *x 没有初始化, 不能被使用*

所以在括号中, 是一个作用域, 也可以看做一个 TDZ(temporary dead zone)
