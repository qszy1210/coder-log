---
title: javascript优先级注意点
date:  2019-05-06
tags: javascript优先级
categories: "2019-05-06"
---

# javascript 优先级

注意一下 && 和 == 号之间的优先级关系

请首先看如下代码, 判断下 && 和 == 的优先级

```javascript
const emptyObj = {name: "kylin"};
if (emptyObj && emptyObj.name === "kylin") {
    console.log("my name is kylin");
}
```
首先说明
** == 的优先级是高于 && 的 **

>  可能大家自己逻辑判断的时候, 其实是想判断下 emptyObj 是非空, 然后再比较 emptyObj.name 与 keylin 的关系, 但这里的执行顺序就有了问题

如果

```js
const emptyObj = null;
if (emptyObj && emptyObj.name === "kylin") { //Uncaught ReferenceError: empty is not defined
    console.log("my name is kylin");
}

```

fix: (需要添加括号修正优先级)

```js
const emptyObj = null;
if ((emptyObj && emptyObj.name) === "kylin") { //Uncaught ReferenceError: empty is not defined
    console.log("my name is kylin");
}

```




