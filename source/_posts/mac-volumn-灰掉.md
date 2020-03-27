---
title: mac-volumn-灰掉的解决方法
date: 2020-03-27 23:57:24
tags:
---


执行命令

```shell
sudo kill -9 `ps ax|grep 'coreaudio[a-z]' |awk '{print $1}'`
```

## 参考链接
https://blog.csdn.net/qq_25737169/article/details/80250390