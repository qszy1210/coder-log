---
title: 由一个聚焦-focus-事件异常跟踪引起的总结
date: 2020-07-11 17:32:52
tags: focus
---

测试同学提了一个问题, 问题的具体现象为
> 一个dialog出现后, 其中的`input`内容有聚焦, 但是确不能通过 `tab` 移动到下一个 `input` 输入框

我感觉也很是奇怪, 但是只要用鼠标点击 `dialog` 浮层的任何一个位置就可以进行正常的操作了(通过tab进行input的移动)

奇怪的是, 我如果不用鼠标点击的情况下, 只输入文字是可以改变 `input` 的内容的.

### 分析

现象描述完毕, 我开始了自己的分析. 背景: 这个组件是另一个同学开发的, 并且已经是 N 手组件了.

#### 1. 确认是否为聚焦元素
通过 `document.activeElement` 是可以获取的. 但是我只要打印的时候, 那可能就会影响 activeElement
所以, 我设置了一个 interval 进行打印

通过事先在控制台输入

```js

setInterval(()=>{

    console.log(document.activeElement);

}, 500)

```

但是这种方法有点low, 控制台会一直打印. 鉴于我这种情况, 是响应 输入的, 所以我就在键盘输入的时候打印

```js
document.addEventListener('keydown', function(e){
    console.log(e.target);
    console.log(document.activeElement);
})
```

结果是: 当前的 activeElement 就是我的 `input` , 所以我需要继续研究这个奇怪

#### 2. keyboard 时间是否被其他捕获了呢?

通过我细致观察, 发现我鼠标点击的时候, dialog 后边浮层的表格会有变化, 细致观察是类似一个 `blur` 的效果.
经过跟踪, 发现这个只是一个效果, 的确触发了这个类似 `blur` 的事件 handler

那怎么获取一个元素有哪些事件呢?

万能的internet告诉了我们, 通过目前多数浏览器支持的方法 `getEventListeners` 其他的还有 `event-debug` 的插件

```js
window.getEventListeners('document')
```

其实我原来大部分是通过 chrome 的 调试工具去查看, 其中有显示 event 相关调试. 更有 `eventListener breakpoints`

方便的设置自己的调试.

#### 结果

经过跟踪也是发现 `keyboard` 事件被拦截了, 所以 `tab` 键盘事件不正常. 但是我点击之后, 触发了 `类似失焦` 的一个事件,
释放了对 `keyboard` 事件的捕获.

跟踪到结果, 自然针对我这个项目可以去跟踪释放的方法了, 这个就是我项目内部的事情了....

#### 总结与反思

很多事情, 遇到了的确感觉很奇怪, 但还是那句话 `There is no magic, 程序的世界没有魔法`
思路和思想是最重要的, 指引你去分析问题. 而基本的思路与牢固的基础是密不可分的.
通过分析, 跟踪, 问题还是很容易追踪到的.

感叹: 目前的前端开发复杂了许多, 但也大大便利了好多, chrome 的调试工具不要太方便呀~






