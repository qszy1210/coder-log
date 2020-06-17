---
title: application/javascript+text/javascriopt
date: 2019-08-17 15:52:17
tags:
categories: "http"
---

## 关于 mime 中的 application/javascript 和 text/javascript 的疑问

在拜读 [阮大es6](http://es6.ruanyifeng.com/#docs/module-loader) 教程的时候,发现了一处代码

```js
<script type="application/javscript" src="..." />
```

原来很多的时候是使用 "text/javascript" 的, 所以这里有了一些疑问. 经过搜索发现了一些事情:

`text/javascript` 已经被废弃, 建议使用  `application/javscript`, 但是 `text/javascript` 的兼容性好一些.

参考自[SO](https://stackoverflow.com/questions/21098865/text-javascript-vs-application-javascript)

## 一些进一步的

在 h5 中, 默认的 type 是可以不用增加的, 直接写 `<script src="" />`即可以, 但其实在
h4 的时候就可以这么使用了, 虽然默认规则中规定了此处.

在 `es6` 中是新增的值为 `module`, 如下

```html
<script type="module" src=".." />
```

这样浏览器就知道是 `es6` 的模块, 就会去按照 es6 的规则去加载
