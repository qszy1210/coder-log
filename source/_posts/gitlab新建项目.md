---
title: gitlab新建项目
date: 2020-12-29 18:33:05
tags:
---

提交的时候遇到的问题

```shell
git clone [git@xxx地址]

git add . -A
git commit -m "xxxx"


git push

```

上边执行 `git push` 之后会报错

```shell
Counting objects: 3, done.
Writing objects: 100% (3/3), 226 bytes | 226.00 KiB/s, done.
Total 3 (delta 0), reused 0 (delta 0)
remote: GitLab:
remote: A default branch (e.g. master) does not yet exist for project/cects/fe-console-quota-cecloud-com
remote: Ask a project Owner or Maintainer to create a default branch:
....
error: failed to push some refs to 'xxxx.git'
```
主要注意这句

```shell
Ask a project Owner or Maintainer to create a default branch
```

说明我们的用户权限有问题, 并且没有默认的一个分支.

1. 去菜单 `memebers` 里边确认了自己是  `developer` 权限. 尴尬.

> 有可能即使是你新建的项目, 如果是在组下边的话, 也可能是没有权限的, 因为是按照默认权限去创建的这个项目

2. 与管理员大大沟通一下, 获取权限.
3. 新建一个 readme 文件, 提交一下. 即 创建了远程的 master 分支.

> 如果不创建的话, 其他 devleoper 也是提交不上的, 因为第一步是要进行分支的创建的.


