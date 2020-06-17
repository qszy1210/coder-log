---
title: linux grep 查询多行的方法
date:  2019-04-09
tags: linux grep
categories: "linux"
---

### linux grep 查询多行的方法

经常查询 git log 中使用的方法, 如下

git log |grep "xxxx"

如果想查询多行的话, 就有些尴尬, 如果想查询多行的话, 方法如下:

//查询上下
git log |grep "xxxx" -C 5

//查询往后 after
git log |grep "xxxx" -A 5

//查询往前 before
git log |grep "xxxx" -B 5