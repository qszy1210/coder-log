---
title: promose的es5实现
date: 2018-11-21 22:58:54
tags:
---

## promise 的 es5 实现

首先要理解promise的几个关键点

状态三种
then返回的是新的promise
then的方法中必须要有返回值, 下一个链式的 then 才能够接收到.
直接的 promise 实例, 可以直接 then, thne 会接收 resolve 或者 reject 的结果.
