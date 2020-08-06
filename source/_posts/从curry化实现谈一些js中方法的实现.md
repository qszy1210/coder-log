---
title: 从curry化实现谈一些js中方法的实现
date: 2020-08-05 21:28:15
tags: curry
---

## curry 化的实现

一般的场景是这个样子, 必然有一个函数可以接受多个参数, 但是我们可以分多次调用传入

比如 `function sum(a, b, c) {return a+b+c}`

调用时候实现方式如 `curryingSum(1)(2)(3)` 也可以实现调用,

需要提供一个 `currying` 函数, 将传入的方法进行处理.

核心使用原则是 `递归` 和 `方法的长度属性`. 不断将调用的参数传入, 并记录参数长度

recurs 和  fn.length

```js
const currying = (fn, ...arg1) => (...arg2) =>
{
    console.log(arg2 && arg2.toString());
    console.log('length is ', [...arg2, ...arg1].length, JSON.stringify([...arg2, ...arg1]));
    //主要是使用了 fn 中的 length 属性作为判断
    return [...arg2, ...arg1].length === fn.length ?
    fn.apply(null, [...arg1, ...arg2]) :
    //注意这里的传入, 是采用解析的方式传入的, 与定义时候的声明是一致的.
    //如果定义的时候要接收数组, 那么这里也需要传入数组,
    //定义方式 (fn, ...arg1) 的形式, 即为分别参数的形式, 如果是 (fn, arg1), 代码中实际当做数组去使用的话, 那么这里就可以传忰
    currying(fn, ...arg1, ...arg2)}

function sum(a,b,c){
    console.log('abc is', a,b,c);
    return a+b+c};

var c = currying(sum);

console.log(c(1)(2)(3));
```

## 总结与思考

1. 其中的 arg1, arg2 的顺序为什么这么去写
2. 即, 形如 `c(1)(2)(3)` 我的实际调用顺序是 1=>2=>3 还是 3=>2=>1 呢, 又比如我增加括号 `((c(1))(2))(3)` 会有什么变化么?
3. 通过 `fn.length` 去做属性判断, 那是否不定参数的就有问题了呢?

回答:
前两个问题可以归结为调用顺序, 按照 js 优先级, 调用的顺序是**从左到右**依次进行的, 所以增加括号是一个含义,
先执行 `c(1)` 发现返回是一个函数, 才可以继续执行 `c(1)(2)`, 以后依次进行.
所以我们的调用顺序与声明顺序就是一致的.
比如以下测试函数

```js
const sequence = a=>(console.log(a), b=>(console.log(b), c=>{console.log(c)}));
sequence(1,2,3)
```

第三个问题, 既然是不定参数, 此问题似乎也失去了意义, 原来的方法首先就支持不定参数的处理了.

## 后记

重新回顾此问题, 是因为 redux 中到处 `curry` 的应用. 比如 `middleare` 的定义

```js
const aMiddleware = store=>next=>action=>{
    //next 就是 dispatch
}

//应用的地方
applyMiddleware(aMiddleware)
//内部调用逻辑
/**
 * 1. 首先要给传入一个 store, 所以其中转化为数组的地方进行了调用
 * middlewares.map(m=>m(store))
 * 2. 然后传入 dispatch, 通过 compose 进行从右到左实现嵌套调用
 * 3. 调用后, 返回值形如 action=>{....}, 即 dispatch
 * 4. middleware 最终封装返回 store  {...store, dispatch}, 即将 dispatch 进行复写
 *
 * **/

```











