---
title: 2019-10-11-js-tofixed
date: 2019-10-11 15:25:46
tags: tofixed math
categories: "javascript"
---

## js 原生 toFixed 方法修正

思路: toFixed 方法存在 要进位的那位, 如果前边是奇数, 那么会直接舍去 5(包括) 以下的数字, 这个是通常的流行方法,
但是测试如下

```js
(1.365).toFixed(2) //结果为 1.36, 按照上边的说法应该是 1.37 的
```

不管如何, toFixed 方法有问题, 需要进行处理. 通常的处理方式是采用扩大后, +0.5, 然后 parseInt 的方式进行处理

如下

```js
function toFixed(num, len) {
    const power = Math.pow(10, len);
    //+0.5, 如果最后一位为0.5, 那么会直接进位变1, parseInt 取整后, 即进位
    const tmp = parseInt(num * power + 0.5);
    return tmp/power;
}
```

其他的思路, 可以专门处理 toFixed 具体的位数, 查看是否为大于 5 进行主动进位.

或者采用其他公共库, 比如 decimal.js
