---
title: vim查找替换
tags: vim
date: 2019-12-24 15:03:13
---


### vim 查找替换

vim 非常强大, 查找 和 替换操作算是比较常用的

## 查找 / 和 ?

一个是正向查找, 一个是反向查找

## 替换

主要是用 s 进行替换, %s 处理所有行

1. 替换当前行第一个  :s/aaa/bbb/ 替换*当前行* *第一个* aaa 为 bbb
2. 替换当前行所有 :s/aaa/bbb/g 替换*当前行* *所有* aaa 为 bbb
3. 替换多行 :n,$s/aaa/bbb/ 替换*n到最后一行* *第一个* aaa 为 bbb
4. 替换多行 :n,$s/aaa/bbb/g 替换 n 到最后一行  所有  aaa 为 bbb
5. 替换当前行到最后一行 :.,$s/aaa/bbb/g
6. 替换所有行第一个 :%s/aaa/bbb/ 替换所有行第一个
7. 替换所有行 :%s/aaa/bbb/g 替换所有行的
8. 替换的间隔符用 # 或者 + 例如  :%s#/aaa#/bbb#g 替换所有 "/aaa" 为 "/bbb"  :%s+/aaa+bbb+g 将 "/aaa" 替换为 bbb 范围为一行所有


参考地址[博客园](https://www.cnblogs.com/ltang/articles/2034291.html)