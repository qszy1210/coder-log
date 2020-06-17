---
title: 再谈reduce
date: 2020-04-17 15:59:02
tags: javascript reduce
categories: "javascript"
---

## 对于reduce的认识

引子:
经常会用到 reducer, 并且80%以上的时候都会用于计算 加和. 所以, 在我的记忆模型中
reder 是这样的

```js
[1,2,3].reduce((sum, cur)=>{...},0);
```

第一个就是 sum 的内容, 所以我要做的一个事情, 自然就是要处理 sum, 所以 `...` 中的内容补全

```js
[1,2,3].reduce((sum, cur)=>{
    sum = sum + cur
    return sum;
},0);
```

看起来仍然没有问题, 但是这里却隐藏着一个很大的误解, 就是根本不用执行赋值的这一步.
reduer 的作用就是 **会将上一次的返回结果赋值到第一个参数中**, 这个才是reduce 的强大作用
所以, 可以简单写为

```js
[1,2,3].reduce((sum, cur)=>sum+cur, 0)
```

也可以传递引用:
用来执行连续的 promise, 由于 then 返回的仍然为 promise, 所以, 把当前的都放在 then 中进行处理.
处理结果会复制给下一次, 等下一次执行的时候, 直接再次执行 then. 实现顺序执行

```js
const promises = [promise1, promise2, ...];

promises.reduce((pre, cur)=>{
    return pre.then(d=>cur)
}, Promise.resolve())

```
