---
title: iso定位调整真机调试
date: 2019-09-12 10:37:50
tags: iphone 真机调试
---

## 小白在xcode下的真机(iphone)调试和定位路程

1. 首先 xcode 新建一个项目
2. 然后新建一个gpx文件, 待后边 debug -> simulator location 的时候选择使用
3. 真机运行 (遇到很多坑)
   1. (一句话)需要登录apple id, 需要有一个 team, 需要版本符合
      1. 登录后, 提示我账号不能用... 这个我申请好多次了, 并不可以, 无奈, 更换一个账号 [开发者首页](https://developer.apple.com/account )
         1. Need assistance with accessing your developer account?
      2. 然后如果编辑的时候报 Signing for "XXXXXX" requires a development team. Select a development
         1. 在全部中 signing 中, 取消掉自动勾选 automatic management signing, 然后自动获取(最新版本的是可以不用整数进行真机打包了)
         2. 有比较低的版本中, 说是需要去掉 entitlement, 或者禁用掉 icloud, 我的并没有遇到
      3. 然后报版本问题, Code signing is required for product type 'Application' in SDK 'iOS 11.4'
         1. 增加sdk, 给一个 github, 先找的地址是不行的, 我只好更换了一个. 参考地址 [ios device support](https://github.com/filsv/iPhoneOSDeviceSupport)
      4. 然后报我的手机很忙的问题 (is busy), 等待就好了. 其实是在准备我手机的环境, 或者百度一下如下内容, 在 window 中进行手动触发下点击按钮
         1. phonex is busy: Preparing debugger support for Qsphonex
      5. 最后在自己手机的设置->通用->增加自己的信任
