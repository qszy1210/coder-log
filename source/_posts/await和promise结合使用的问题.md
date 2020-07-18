---
title: await和promise结合使用的问题
date: 2020-07-18 23:17:25
tags: promise
---

## await和promise结合使用的问题

由于目前(2020)的情况, 我们写东西的时候, 通过 babel 的转译(transpile), await 和 async 和 promise 经常会有一起的情况.

工作中直接跟踪代码, 发现有一些序列上的问题需要注意

比如, 多个promise一起并行的情况

```js

new Promise(rel=>rel('ok1')).then(d=>console.log(d)).then(d=>console.log(1));
new Promise(rel=>rel('ok2')).then(d=>console.log(d)).then(d=>console.log(2));

```
这种情况下, 我们的执行, 并不是 首先执行完第一个 `promise`, 而是按照 微队列的进入顺序, 依次进行执行

执行结果
```js
'ok1'
'ok2'
1
2
```

但是如果我们使用了 await 的时候, 情况确有些差别

```js

async function withawait(){
    await new Promise(rel=>rel('ok1')).then(d=>console.log(d)).then(d=>console.log(1));

    /*await //可以没有*/ new Promise(rel=>rel('ok2')).then(d=>console.log(d)).then(d=>console.log(2));
}

withawait()
```

执行结果
```js
'ok1'
1
'ok2'
3
```

其实我们从语义上去理解, await 就是要让后边等待我后边的异步队列进行执行完成, `.then` 也是返回的异步队列.

默认的情况下, 我们的 `async 和 await ` 修饰后的方法是直接返回一个 `promise` 的.

比如

```js
async function retPromise(){
    return await 2;
}

retPromise() instanceof Promise // true

```

总结: js 是快速发展的, 队列,异步也是js的核心. 需要对其中有一些基本的理解才能够更好的运用.

