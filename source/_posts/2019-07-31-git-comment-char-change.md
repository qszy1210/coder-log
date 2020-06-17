---
title: 2019-07-31-git-comment-char-change
date: 2019-07-31 13:52:03
tags: git comment
categories: "git"
---

# 更改默认git的注释符号

如果git中的comment需要增加 # 的标志, 特别是以 首字符开头的, 比如我们的项目提交规范为:

```

git comment -m "#xxxx#  xxxx";

```

此种情况下导致了很多的 rebabse 操作会提示空提交, 导致操作非常麻烦.

可以更过以下命令进行默认的注释符号的更改

```

git config --global core.commentChar ";" # 更改全局, 并且将注释符号更改为 ";"

```

参考链接: [stackoverflow](https://stackoverflow.com/questions/2788092/start-a-git-commit-message-with-a-hashmark/14931661#14931661)

