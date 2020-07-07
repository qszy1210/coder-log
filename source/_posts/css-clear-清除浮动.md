---
title: css-clear-清除浮动
date: 2020-07-07 20:23:50
tags: css
---

# css-clear-清除浮动

经常使用 `clear: both`  进行浮动清除, 也知道有两个属性

`clear: left`  `clear: right` , 但是不经常使用.

看了 <<css 世界>> 后, 有了一些理解. 增加了自己的一个测试说明.

整体概括如下:

1. clear 用于清除浮动, 清除的意思是, 不与浮动的元素相邻.
2. left 或者 right 的意思是, 清除的是 左浮动 还是 右浮动
3. **只清除当前样式作用的元素前边(实际的元素前边, 即文档流中的, 你实际书写的html前边的元素)**
4. 所以, `clear: left` 的意思是 前边不与左浮动相邻, 如果有相邻的, 那么会换行处理(**不会改变其他人, 只能改变自己**)
5. `clear: right` 同理

但是 `float` 属性要么 `left` 要么 `right`

所以, 当两个元素, 一个是 `clear: left` 的时候, 作用的是 前边的 `float: left` 的元素, 前边的 `float: right` 不生效
所以, 当两个元素, 一个是 `clear: right` 的时候, 作用的是 前边的 `float: right` 的元素, 前边的  `float: left` 不生效

所以, 总是一边生效, 直接都采用 `clear: both` 是一样的效果的. 如果 **你想生效的话**,

eg: 如果本来就设置了一个不生效的样式 `clear: right` 面对 `float: left` 的时候, 那自然不能去用替换

下边是一些演示代码:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .container{
            float: left;
        }

        .float-left{
            float: left;
        }
        .float-right{
            float: right;
        }

        .clear-left {
            clear: left;
        }
        .clear-right {
            clear: right;
        }
        .clear-both {
            clear: both;
        }

    </style>
</head>
<body>

    <br />
    <br />
    <br />
    <!-- 前边不与左浮动接壤, 因为此处是右浮动, 所以没效果 -->
    <div class="container">
        <div class="float-right">float-right1</div>
        <div class="float-right">float-right2</div>
        <div class="float-right clear-left">float-right3</div>
    </div>
    <br />
    <br />
    <br />
    <!-- 前边不与右浮动接壤, 因为此处是右浮动, 所以有效果, 换行 -->
    <div class="container">
        <div class="float-right">float-right1</div>
        <div class="float-right">float-right2</div>
        <div class="float-right clear-right">float-right3</div>
    </div>

    <br />
    <br />
    <br />
    <!-- 前边不与左浮动接壤, 前边有一个左浮动, 所以有效果, 换行 -->
    <div class="container">
        <div class="float-left">float-left1</div>
        <div class="float-right">float-right1</div>
        <div class="float-right clear-left">float-right3</div>
        <div class="float-right">float-right2</div>
    </div>
    <br />
    <br />
    <br />
    <!-- 前边不与左浮动接壤, 前边有一个左浮动, 所以有效果, 换行 -->
    <div class="container">
        <div class="float-left">float-left1</div>
        <div class="float-left">float-left1</div>
        <div class="float-left clear-left">float-left3</div>
    </div>


</body>
</html>
```

