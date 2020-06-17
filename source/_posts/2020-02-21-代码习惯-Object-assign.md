---
title: 代码习惯-Object.assign
tags: rules standard javascriopt
date: 2020-02-21 10:13:22
categories: "javascript"
---


使用 Object.assign 的时候, 我们很多时候习惯如下

```js
const oldObj = {...};
const newObj = Object.assign(oldObj, {newProp: "newProp"})
```

或许很多时候我们就是要去修改 oldObj 来达到目的.
但很多时候这样容易造成一些隐性的错误.

比较建议的做法是:

```js
const newObj = Object.assign({}, oldObj, {newProp: "newProp"})
```

通过一个空对象来进行处理. 这样不会对 oldObj 进行干扰, 还是那句话: **除非你真的要进行修改oldObj**

### 列举一下坑

1. 如果 oldObj 在一些情况下为 空 (null 或者 undefined), 会有错误

```js
Object.assign(null, {...}) //Error
Object.assign(undefined, {...}) //Error
```

2. 就是前边说的, 造成额外的副作用, 如果 oldObj 是一个多出引用的内容, 因为是对象, 就可能造成其他使用者的污染

```js
const newObj = Object.assign(oldObj, {newProp: "newProp"});
....

//下边有其他地方用到 oldObj, 并且是不想修改的, 不知晓上边有修改
handle(oldObj) //可能出现一些额外的未知错误

```