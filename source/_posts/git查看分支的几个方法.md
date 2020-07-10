---
title: git查看分支的几个方法
date: 2020-07-10 09:07:49
tags: git
---

平常使用 `git` 多分支的情况下, 需要将查看 `git` 分支的很多种情况.

总结了一下自己高频使用的场景:

1. 查看分支

```shell
git branch #列出**本地**所有的分支
```

2. 查看分支详细信息

```shell
git branch -v #列出本地所有的分支, + hash 信息
```

3. 查看分支与远程的关联

```shell
git branch -vv #列出本地所有的分支, + hash 信息 + 与远程的关联信息
```

虽然默认本地和远程大部分都是同名的, 但是在多分支的场景下还是会出现不同名的情况
通过这个命令进行确认, 非常好用.

4. 查看所有分支

```shell
git branch -a #列出所有的分支(远程和本地)
```
这个命令在拉取别人的分支的时候非常有用, 比如

```shell
git branch -a | grep xxx
git branch -o xxx origin/xxx
```

