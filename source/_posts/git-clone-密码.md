---
title: git-clone-密码
date: 2020-09-14 08:05:10
tags: git clone
---

## git clone 需要用户名密码的一个小问题

例如

```shell
git clone username:password@domain.com
```

正好我password密码中有一个 @， 让我很难受
直接输入的话, 就会识别为域名不可以输入

尝试了  ''  以及  转译符号 \\ 都不行

突然想到我可以不用密码， 然后会提示我密码的输入的

于是我输入

```shell
git clone username@domain.com
```

在提示输入密码的时候, 进行输入我自己的密码就可以了, 搞定
