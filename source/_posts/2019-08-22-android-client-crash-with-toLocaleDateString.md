---
title: 2019-08-22-android-client-crash-with-toLocaleDateString
date: 2019-08-22 16:57:31
tags: 2038year crash android
---


## android crash with rn

今天同事遇到一个问题, 在日期选择空间中 如果选择到 2038年以上的话, 点击保存的时候, 会突然崩溃.
既然是选择到了 2038 年, 所以自然就想到了 2038 年问题.

一搜索一大堆的 2038年问题, 大家说得头头是道, 比如 [聊聊Linux2038年问题](https://blog.csdn.net/linyt/article/details/52728910)

但是这些问题都是集中在 16 位操作系统上的, 对于部分的手机可能也会有, 但是对于我们的安卓机器来说应该不大可能.
虽然我们认为是这个问题.

但是前边我说道 *点击保存的时候, 会突然崩溃*, 就是在有了额外操作的时候才会闪退.

所以, 我们经过 *不断的二分代码注释法*后发现了 toLocaleDateString 的问题, 正好这个问题也只是在 android 机器上出现
于是万能的 [SO](https://stackoverflow.com) 帮助了我. [Android client crashes when using toLocaleDateString()](https://github.com/expo/expo/issues/847).

这个是一个固有bug, 但是只有在 2038年后才会有问题, 所以这个方法应该也是因为16位遗留问题没有进行处理吧.

参考链接:
https://github.com/expo/expo/issues/847

