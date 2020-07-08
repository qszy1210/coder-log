---
title: 给Promise在外部增加断点
date: 2020-07-08 11:12:50
tags: js debug
---

跟踪问题的时候, 我想在每一个promise的then后边增加一个日志, 打印一下每一个 `then` 输出的结果.

于是有了这个问题, 直接想到的是要复写 `promise` 中的 `then` 方法.

但是 `then` 方法是在实例上的, 所以, 想到了可以通过 proxy 代理进行

```js
var p = new Promise(rel=>rel('ok'));

var proxyP = new Proxy(p,{
    get(target, ...args){
        console.log('111')
        return Reflect.get(target, ...args).bind(target);
    }
})

proxyP.then(d=>console.log(d))

//这样每次都会进行输出 111 了, 当然你也可以打印其他的内容

```

总结:
需要注意其中的 `bind` 的问题, 网上好多人遇到了这个问题.
附上其中的参考链接
[stackoverflow](https://stackoverflow.com/questions/30819290/how-to-proxy-a-promise-in-javascript-es6)
[zhihu](https://zhuanlan.zhihu.com/p/141451626)


