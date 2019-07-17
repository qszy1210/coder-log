---
title: 2019-07-16-flat-array
date: 2019-07-16 20:14:30
tags: array flat
---

# 记录一个 concat 实现的数组 flat 方法

```js
function flat(arr){
    return [].concat(...arr.map(i=>Object.prototype.toString.call(i)==='[object Array]'?flat(i):i))
}
```
