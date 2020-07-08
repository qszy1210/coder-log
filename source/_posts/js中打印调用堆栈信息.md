---
title: js中调试技巧-打印日志信息
date: 2020-07-08 09:54:22
tags: js debug
---

## js中调试技巧-打印日志信息

平常调试代码的时候, 大部分情况下我们会采用 `console.log` 的形式进行处理.

但是这个是非常费事费力的一件事情. 因为这个地方是要进行代码的修改, 然后经过代码的 reload 之后,

是一件非常低效的事情. **而我们程序员是不会做低效的事情的**

针对自己在工作中的场景, 总结了一下几种比较搞笑的方法进行打印

1. 使用 dev-tools 打印变量信息
  > chrome 调试工具非常强大, 我们可以首先采用其中的调试工具来进行打印
  1. watcher  选择调试的代码变量或者表达式, 将其加入到 观察队列中, 运行到此处就会显示出信息
  2. 增加 **断点log** , 看图说话, 另外的几个功能也非常实用. 跟增加条件断点类似, 不过这里的会在控制台直接打印出来
     > 要说的是: 如果想设置一些额外信息, 也可以将变量挂载到 windows 全局上, 然后在下一个断点进行使用, 非常方便
   {% asset_img logpoint.png %}
  3. 手工输入 console.log. 可以实现将需要处理的变量挂载到 全局 windows 上去.
    比如我需要观察 `obj` 对象, 然后我可以这个样子

    ```js

        window.obj = obj;

    ```

    这样处理的时候, 只要在控制台直接输出 `console.log(window.obj)` 就可以了.
2. 打印调用栈信息
   > 本来写这个主题就是打印堆栈信息的, 一下子变成打印日志信息了....

   1. console.trace(). 专事专办, 这个方法就是可以用来记录的.
   2. 如果不支持, 我们可以通过 arguments 中的 callee 和 caller 进行 (如果 es6 禁用掉了的话..., 那 console.trace 方法肯定支持)

      方法如下
      ```js
        function trace () {
            var currentFunction = arguments.callee;
            var caller = currentFunction.caller;
            //当然你也可以增加层级控制, 见下边
            while(caller) {
                console.log(caller);
                caller = caller.caller;
            }
        }

        //增加一下层及控制
        //level: number
        function trace(level = 0) {
            var currentFunction = arguments.callee;
            var caller = currentFunction.caller;
            var count = 0;
            while(caller && count < level) {
                console.log(caller);
                caller = caller.caller;
                count ++;
            }
        }
      ```
### 简单说下 callee 和 caller

callee 其实就是方法自己, 通过 arguments 可以访问到
caller 指向调用当前方法的对象

所以, 比如以下代码

```js

function a() {
    console.log(arguments.callee.caller.caller)
}

function b() {
    a();
}

function c() {
    b();
}

c();
```

就会打印

```js
ƒ c() {
b();
}
```
## 其他的一个小技巧

chrome 还支持将打印的日志直接保存成文件, 便于统一通过 ide 进行分析

`在打印输出的日志上边 右键 另存为即可~`

