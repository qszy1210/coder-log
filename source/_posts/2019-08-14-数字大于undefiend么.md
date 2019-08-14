---
title: 数字大于undefiend么
date: 2019-08-14 10:44:12
tags: parseInt NaN
---

# 数字大于undefiend么?

一个很简单的比较, 如下

```js

(5>undefined) //false
(5>null) //true

```

## 延伸讨论

### 隐式转换的问题

这里边有数字比较, undefined 和 null 会默认转换为 数字
但是呢

```js
parseInt(undefined) // NaN
parseInt(null)//0

5>NaN //false, 数字和 NaN 比较, 直接短路返回 false

```

5>NaN //false, 数字和 NaN 比较, 直接短路返回 false
所以, 这里直接获取false, 但是大多数情况下, 我们是想返回true的, 即将 undefined 当做0进行处理.

### 变量赋值的问题

这里就想到了, 在类似的问题中, 如果进行变量提取是否更好, 进行以下处理
> 看起来很简单的处理, 但是如果形成了代码习惯, 是很好的可以避免一些未知错误的.
比如

```js
var a = xxxx; //要增加 || 0 的判断
if (a > b) {

}
```
