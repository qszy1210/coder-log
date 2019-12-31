---
title: mac-volumn-灰掉
tags:
---

执行命令

```shell
sudo kill -9 `ps ax|grep 'coreaudio[a-z]' |awk '{print $1}'`
```

## 参考链接
https://blog.csdn.net/qq_25737169/article/details/80250390