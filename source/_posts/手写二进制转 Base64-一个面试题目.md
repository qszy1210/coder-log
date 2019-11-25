---
title: 手写二进制转 Base64-一个面试题目
date: 2019-11-01 11:18:14
tags: base64
---

## 手写base64-一个面试题目

一个将二进制转换为 base64 的题目, 上来感觉到要进行得很详细, 进行到字节的处理.
但是感觉如果是这个样子的话, 就失去了本来的意义.

二进制转换为 base64, 即将二进制进行读取, 然后转换为字符的处理.

比如以下的字符串

```js
var numberArr = [...'hello'].map(i=>i.charCodeAt(0))
// [104, 101, 108, 108, 111]
```

可以理解成一串的二进制字符.
可以通过 Uint8Array 进行读取

```js
new Uint8Array(...numberArr)
```

通过 Uint8Array 进行转换, 获取到实际的 code

然后通过 String.fromCharCode(...) 进行转换.

整体如下:

```js
String.fromCharCode(...new Uint8Array([...'hello'].map((i,ii)=>i.charCodeAt(0))))
```

todos: 感觉还是有问题 ....
