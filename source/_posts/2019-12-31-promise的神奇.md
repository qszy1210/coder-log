---
title: promise的神奇
tags: promise
date: 2019-12-31 14:44:56
---


## 给你一个许诺

一直&以前 对 promise 的理解, 都是类似 ajax 一般, 就是处理异步请求的.
并没有感觉这个有多么大的用户.

但当稍微认真看一下 promise 之后就知道不是这个样子.

看下边的例子:

```js
new Promise ((rel, rej)=>{})
```

经常书写的 promise 的声明, promise 接收一个函数, 函数中可以传入两个方法
一个是执行成功, 一个是执行失败. 然后通过 then 就可以接着执行.

但是 promise 的强大在于 rel 或者 rej 中也是可以接收 promise 的

比如

```js
new Promise((rel, rej)=>{
    rel(new Promise((r,j)=>{
        r('ok')
    }))
}).then(data=>{
    console.log(data);
})
```

如果接收了一个 promise , 我会默认去执行其中的 promise, 并把其中的 promise 作为返回
上述打印出来的结果为 'ok'.

即在一些场景中, 我需要等待你执行完成后, 再做一些事情, 类似回调, 我可以通过promise的方式进行实现.

```js
new Promise((rel, rej) => {
    rel(new Promise((r, j) => {

        setTimeout(function () {
            r('ok')
        }, 3000)

    }))
}).then(data => {
    console.log(data);
})
```

其实就是回调的形式, 但是外层接收一个 promise 后, 就可以等待内层的执行完毕后再进行处理.
当然你也可以说我用 async/await 一样实现
比如

```js
async function aa() {
    const a = await new Promise((r, j) => {

        setTimeout(function () {
            r('ok')
        }, 3000)

    });
    console.log(a)
}
aa();
```

多一种场景, 多一种实现方式, 理解了 promise 后, 更方便去使用其中的场景. 对 async/await 也更大胆的去使用.

