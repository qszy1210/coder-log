---
title: git-remove
date: 2019-12-24 14:41:46
tags:
---


## git remove 删除git中不需要的问题件

### 1. 删除文件(默认是删除不被忽略的文件, 如果gitignore中忽略的文件默认是不进行处理的)

```shell
git remove -fd xxx
```

### 2. 删除忽略的文件 大写的 X

```shell
git remove -fX xxx
```

### 3. 删除文件(所有, 不管是否忽略) --  小写的 x

```shell
git remove -fx
```

> 英语原文:
>How to remove local untracked files from the current Git branch
>To remove directories, run git clean -f -d or git clean -fd.
>To remove ignored files, run git clean -f -X or git clean -fX.
>To remove ignored and non-ignored files, run git clean -f -x or git clean -fx.
