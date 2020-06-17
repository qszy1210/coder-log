---
title: 怎么将typescript应用到自己写的js文件中
date: 2019-12-12 20:18:50
tags:
categories: "javascript"
---


## 怎么将typescript应用到自己写的js文件中

例如自己写的一个没有 typescript 支持的代码, 怎么讲这个运用到自己的项目中呢?

比如首先我有一个js文件

```js
// a.js
export class Person {
    name
}
export const name = {
    a: 1,
    b: 'a'
}

```

这个文件直接引用的情况下, ts 默认是检测不到其中的类型的.

这个时候需要在同目录下新建一个同名文件 a.ts

```ts
//a.d.ts
export declare interface Person{
    name: string
}

export declare type name {
    a: number;
    b: string
}
```

这样直接引用的话, ts 会去查找对应的 xx.d.ts 文件, 然后按照结构进行解析

其中里边使用 interface  和 type  或者 class 也是可以的.
但是我实际测试, 感觉使用 interface 或者 type 更符合语义.

declare 的意思其实就是告诉 ts, 这个地方已经有声明了. 即通过这个地方来实现
自定义的 js 文件中的结构
