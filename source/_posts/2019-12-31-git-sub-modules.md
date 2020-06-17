---
title: git-sub-modules
tags: git submodules
date: 2019-12-31 14:31:05
categories: "git"
---


## git 管理多个子git - 学习

如果git项目管理的项目中有子目录,并且子目录是其他引入的,
主要是对下边的教程的一个大体翻译

### 2.1 克隆一个包含子模块的git项目

```shell
git clone --recursive [url]
```

如果已经克隆完了, 需要使用的话 (非常重要, 这个克隆完别人的项目后, 进行使用的时候要用到)

```shell
git submodule update --init
## 如果内层有嵌套的子模块
git submodule update --init --recursive
```

### 2.2 同时下载多个模块

如果有多个模块同时需要进行下载, 可以指定同时下载的任务数目

```shell
git submodule update --init --recursive --jobs 8
git clone --recursive --jobs 8

# 缩写
git submodule update --init --recursive -j 8
```

### 2.3 拉取远程

```shell
# 拉去所有包括在子模块中的变化
git pull --resursive-submodules

# 或者使用 git submodule 命令
git submodule update --remote
```

### 2.4 在每一个子模块中执行命令

```shell
git submodule foreach 'git reset --hard'
## 执行所有的子模块
git submodule foreach --recursive 'git reset --hard'
```

### 3.1 新建一个git子模块, 并跟踪远程分支

```shell
## 指定branch名称
git submodule add -b master [url]
# 初始化子模块
git submodule init

# 更新分支
git submodule update --remote
```

### 3.2 新建一个 git 子模块, 并跟踪远程提交(按照默认设置进行处理)

```shell
git submodule  add [url]
git submodule init
```

### 3.3 如何更新具体

注意其中的 isActive 属性, 需要进行更改为 false 即可.

### 问题处理 -- 乱起八糟

```shell
git ls-files --stage | grep 160000
```
地址:
https://stackoverflow.com/questions/4185365/no-submodule-mapping-found-in-gitmodule-for-a-path-thats-not-a-submodule


### 参考地址

[https://www.vogella.com/tutorials/GitSubmodules/article.html](https://www.vogella.com/tutorials/GitSubmodules/article.html)
