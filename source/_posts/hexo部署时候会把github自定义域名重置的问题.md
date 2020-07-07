---
title: hexo部署时候会把github自定义域名重置的问题
date: 2020-07-07 21:05:36
tags:
---

每次自动部署 hexo 到 github 上之后, 发现自己的自定义域名给置换为默认的 github.io 的地址了.

解决方法为需要在 `/source` 目录下边设置一个 `CNAME` 文件

具体的参考链接为: [github.io自定义域名重置问题](https://github.com/hexojs/hexo/issues/2446)
