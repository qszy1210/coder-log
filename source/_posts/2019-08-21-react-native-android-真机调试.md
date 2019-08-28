---
title: 2019-08-21-react-native-android-真机调试
date: 2019-08-21 16:11:41
tags: android react native todo
---

## react-native-android-真机调试

先说问题: 一直提示我下载的 maven 库找不到, 不过问题的确是找不到, 这个库挂了.
或者说网络问题(你懂得)

经专门搞 android 的同学研究了一下也不得其法, 只是感觉我这里的 gradle 中的 maven 库
的下载貌似不对.(我是开了代理的情况下, 已经排除网络问题了)

问题如下:
{% asset_img task_failed.png %}

先尝试将所有的默认 maven 库地址进行了替换

```sh
allprojects {
   repositories; buildscript.repositories {
       def REPOSITORY_URL = 'http://maven.aliyun.com/nexus/content/groups/public/'
       all { ArtifactRepository repo ->
           if (repo instanceof MavenArtifactRepository) {
               def url = repo.url.toString()
               if (url.startsWith('https://repo1.maven.org/maven2')
                       || url.startsWith('http://repo1.maven.org/maven2')
                       || url.startsWith('https://jcenter.bintray.com/')
                       || url.startsWith('http://jcenter.bintray.com/')
                       || url.startsWith('https://maven.google.com')
                       || url.startsWith('http://maven.google.com')
               ) {
                   project.logger.lifecycle "Repository ${repo.url} replaced by $REPOSITORY_URL."
                   remove repo
               }
           }
       }
       maven {
           url REPOSITORY_URL
       }
   }
}
```
尝试安装, 仍然一样的错误(没有了网络的阻塞问题了), 因为这个报错的地址是不存在的, 所以肯定解决不了.
经过排查, 感觉是查找的默认 maven 地址不对. 但解决了一处, 另外一处的下载也会有问题了. 感觉 maven 的 rep 有问题

于是首先尝试安装一个 maven, 虽然 gradle 会内置去进行下载...

安装了 maven 和 gradle, 并没有什么用...

待续...

最终解决方法:

将同时的 .gradle 目录 copy 了过来. 拷贝大法好, 我的环境有些问题, 并且这个项目的历史配置也是有问题的.
需要有时间进行一下研究. 奈何我现在只是在做 js 的事情...
