---
title: 关于ShadowSocks连接Dropbox设置
date:  2019-04-09
tags: shadowsocks dropbox
categories: "cloud"
---

# 关于ShadowSocks连接Dropbox设置

> 使用中突然发现dropbox不能连接, 以为是dropbox中的代理有问题了.
> 设置后发现与 ss 的代理并没有问题. 经过反复跟踪才发现了问题
> 特记录一下解决方法

直接给结论:

发现我 ss 服务器的端口让给"科学" 了, 我是自己搭建的 vpn, 所以可以自己设置地址. 如果其他同学遇到类似的问题, 也可以参照一下.

比如我原来的默认的  ss 服务器的地址是 443, 我给更改了一个其他的地址 4433, 然后就可以了.

需要注意的是有可能你设置的新地址也不能用, 多尝试几次. 可能你服务器的多个 端口都被 "科学" 了.

