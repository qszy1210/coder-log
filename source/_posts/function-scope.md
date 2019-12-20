---
title: function-scope
tags: function-scope
date: 2019-12-18 19:57:39
---



```js
var count = 3;
function a (){
    var count =2;
    this.name = function(){
        return function(){
            console.log(count)
        }
    }
}
```

非常简单的一个问题,

```js
var aa = new a();
var b = aa.name();
b(); //输出什么?
```

经常考察的是 this, 但是如果不用 this 呢? 输出的是什么呢

## 答案

2
函数执行的时候, 会回到自己的地方去执行, 这个时候的上下文就是 count = 2

## 总结

这个问题看似非常简单, 但是却是让我犯了一个很大的错误.
我一直在想为什么犯这个错误, 突然想到了如下的格式

```js
var count = 2;
    var a = {
    count: 1,
    b: function(){
        return count; //很多情况下也会是 this.count;
    }
}

a.b()
```

a.b() 会返回 2, 全局的 count

其实还是没有问题, 这里的 a.b() 作为一个全局方法去执行, js 是按照方法进行作用域控制的.
所以, 这个地方等于直接执行一个全局方法, 如果其中返回的是 this.count
那么就会将 a 作为 this 进行处理.

其实很多时候都是 "强理解", 很多东西还是按照它原来的思想去走的.

方法总是会回到原来的地方进行执行, 然后查看上下文环境.

如果是 => 箭头函数,那么箭头函数直接是更改 this 的绑定的, 后续是不可以更改的. 记住了这一点,
其他的也是很好理解的了.
