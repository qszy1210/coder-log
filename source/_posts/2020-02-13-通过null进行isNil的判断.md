---
title: 通过null进行isNil的判断
tags: null javascript isNil
date: 2020-02-13 15:13:14
categories: "javascript"
---


## 判断一个值是否为 Nil 的方法

如题, 很多时候, 我们会这么判断

```js
let a ....;
if (a === null && a === undefined) {
    ....
}
```

或者引入 lodash

```js
const isNil = require('lodash/isNil');
let a ...;

if (isNil(a)) {
    ....
}
```

先抛开这些, 请判断下边的等式

```js
0 == null
'' == null
null == undefined
false == null
'0' == null
```

结果

```js
0 == null//false
'' == null//false
null == undefined//true
false == null//false
'0' == null//false
```

可见, 即使是 ==, **null 除了 等于 undefined 外, 其他的请下都是不相等的**
所以上边的判断, 我们可以简单的写成

```js
let a ....;
if (a == null) {
    ....
}
```

这样就可以了.

收工.