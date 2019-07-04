---
title: 2019-06-25-关于git-cherry-pick的一个疑惑
date: 2019-06-25 15:39:05
tags:
categories: "2019-06"
---

# git cherry-pick 的一个疑惑

> git cherry-pick 非常好用, 但是如果我直接cherry-pick一个与我关系不大的一个文件, 我只想获取其中的一个更改, 是否可行.

上边说的不清楚, 距离如下
我在 test 分支上做了一个提交, 这个提交只有一行

我再 release 分支上想获取这一行的更改, 如果采用 git cherry-pick 是否可以只获取这一行更改呢?

解答: 如果这个文件在release分支上和在test分支上的差异只有这一点的话, 即文件级别的提交如果是线性的, 是可以直接 cherry-pick 过来的.否则会提示冲突.

这个是非常合理的, 避免随意的 cherry-pick 出现一个不可预知的问题.