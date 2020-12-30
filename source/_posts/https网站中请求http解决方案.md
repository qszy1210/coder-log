---
title: https网站中请求http解决方案
date: 2020-12-30 14:42:40
tags:
---

## https网站中请求http解决方案

如果在 https 的网站中有 http 的请求, 目前(2020/12/30)的情况下,
浏览器会默认将请求变更为 https 的请求.

一些并没有好的解决方案, 提一下, 如果想默认执行这种策略的话(不过现在看来已经默认执行了)
可以在 meta 中增加信息

```html
Content-Security-Policy: upgrade-insecure-requests
```
即

```html
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
```

不过这解决不了问题, 解决问题的方案是从后台进行处理, 如果需要暂时的解决方案的话, 那么可以进行一下代理的处理

推荐 [whistle](https://github.com/avwo/whistle) [文档地址](http://wproxy.org/whistle/install.html)

只需要在 配置文件中进行一下转发即可, 一个示例转发

```shell
# 因为已经默认转为 https 了, 所以需要代理 https
# 前边的为目标地址, 后边为代理的实际地址
https:xxx/xxx.com  http:xxx/xxx.com
```

