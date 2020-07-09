---
title: test-your-mind-快速测试自己的代码
date: 2020-07-09 20:12:25
tags:
---

很多事情需要跑一跑才知道, 需要实际运行才深有体会. 快速运行就成了一个小问题. 总结了一下自己常用的一些方式.

比如我们用 `console.log('hello debugger')`

1. 通过浏览器的调试工具进行打印.
方法: 打开调试工具, 输入 `console.log('hello debugger')` 回车.
问题: 可以输出, 但是会受到当前网页的影响, 比如如果我们项目中就把 `console` 给重写了, 打印不出来 `console`
    虽然我可以打开新的网页, 但是偶尔的遇到问题也是比较讨厌的.
2. 通过 jsfiddle
方法:  直接点击链接 [fiddle大神链接](https://jsfiddle.net/)
问题:  很强很强的一个网址, 但是外国的花比较好看的同时也需要爬着梯子看.
扩展: 很多类似的网址, 比如 [codepen](https://codepen.io) [jsbin](http://jsbin.com) 等, 一搜一大推, 国内的也有
3. 通过vsocde 插件, 这个是我推荐的比较快速的
方法: 插件搜索 `code runner`, 安装, 在写好的代码文件中 右键 执行, 当然也有快捷方式~
问题: 运行太快, 不可思议~ 那肯定是需要打开 vscode 了.

vsocde 的出现大大提高了效率, 所以我个人比较推荐 vscode
