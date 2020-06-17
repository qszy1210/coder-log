---
title: node_modules_version
date: 2020-04-16 20:54:29
tags: node npm node_modules_version
categories: "node"
---

## node 中的各个版本

node 相关的版本

```sh
node -v
npm -v
```

然后还有一个 node_modules 版本,
比如以下的地址: `https://github.com/sass/node-sass/releases/tag/v4.9.2`

其中的一个文件  `darwin-x64-59_binding.node`

这个 `-59` 就是一个 node_moduels_version 的意思.

具体解释如下:

> [1]: NODE_MODULE_VERSION 指的是 Node.js 的 ABI (application binary interface) 版本号，用来确定编译 Node.js 的 C++ 库版本，以确定是否可以直接加载而不需重新编译。在早期版本中其作为一位十六进制值来储存，而现在表示为一个整数

参考地址: https://nodejs.org/zh-cn/download/releases/#ref-1
