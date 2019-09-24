---
title: es6箭头函数你真的理解了么
date: 2019-09-18 15:54:33
tags: es6 arrow function let
---

## es6箭头函数你真的理解了么, 感觉自己腮帮子疼

面试题被问到了一个问题, 如下, 是对箭头函数的考察
先看题目: (大体如下)

```javascript
var a = {
    name: "a",
    foo: function () {
        //我自作聪明的认为应该保持此处的 this
        return () => {
            return this.name;
        }
    }
};

var b = {
    name: "b"
};

a.foo().bind(b)()
```
我有点自作聪明的认为, 既然bind了, 箭头函数是保持的父作用域的 this
a.foo().bind(b) 的时候, 更改了当前的 this  为 b 对象,  如注释中的
自然就输出了 b
实际输出了为 a

我回去看了箭头函数的具体解释,

> An arrow function does not have its own this; the this value of the enclosing lexical context is used i.e. Arrow functions follow the normal variable lookup rules. So while searching for this  which is not present in current scope they end up finding this from its **enclosing scope**

我的理解是, 会按照默认的 js 的作用域去查找. 如下的输出就是 b

```javascript
var a = {
    name: "a",
    foo: function () {
        return function () {
            return () => {
                return this.name;
            }
        }
    }
};

var b = {
    name: "b"
};

a.foo().bind(b)()() //b
```

又如这里, 输出的仍然是 a

```javascript
var a = {
    name: "a",
    foo: function () {
        return () => {
            return () => {
                return this.name;
            }
        }
    }
};

var b = {
    name: "b"
};

a.foo().bind(b)()() // a
```

又如以下的语法, 对于新的 let 的语法, 也是如此, i 会保持

```javascript
const arr = [];
for (let i = 0; i < 10; i++) {
    arr.push(function () {
        return i;
    })
}

```

但是如果想用箭头函数, 比如

```javascript
const arr = [];
for (var i = 0; i < 10; i++) {
    arr.push(() => {
        return i;
    })
}

arr[3]()//会输出 10, 并不能保持
```

只有 通过 ```let``` 来进行实现

```Javascript
const arr = [];
for (let i = 0; i < 10; i++) {
    arr.push(() => {
        return i;
    })
}

arr[3]()//会输出 2, 可以保持
```

后记: 对于自己经常用在身边的东西没有更加深入的去了解, 感觉简直是在狠狠扇了自己好几个大嘴巴子
并且是在自己感觉一定要掌握了很基础的东西才能够好好运用的时候.

有的时候感觉自己理解了, 可能也真的理解了, 但必须有足够多的练习和实例才能去发现一些问题.

经常出去去看看, 才能知道自己有几两几斤.
