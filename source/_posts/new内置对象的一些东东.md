---
title: new内置对象的一些东东
date: 2020-02-13 15:22:51
tags:
---


JavaScript 中的内置对象有如下:

```String Number Boolean Date Object Function RegExp Error Array Symbol```

以下的内置对象都可以使用 new 进行, 比如
```new String()``` `new Object()`
但很多情况下, 我们使用 `String()` `Object()` 也是可以的. 这两种情况下 用不用 new 是不是都一样呢

我特意尝试了一下, 在上边的列举中, 以下
使用不使用 new 返回的结果都是一样的.
Object
Array
Function
RegExp
Error

以下是不一样的
String:
new String('a');//对象字符串
String('a');//和直接写 'a' 是一样的, 但是如果是其他类型的话, 等于直接转换为字符串, 比如 String(2)

Number 同 String

Boolean 同 String

Date:
new Date();//返回一个对象类型的当前日期
Date();//返回一个当前日期的字符串, 所以这里是相等的 new Date().toString() === Date()

### 注意

注意一下这两个问题:
String(undefined) 返回 "undefined" 的字符串
String(null) 返回 "null" 的字符串
Object(undefined) 或者 Object(null) 则返回空对象, 同 Object() 相同.
String([null]) 返回的是空字符串 ""
