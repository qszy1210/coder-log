---
title: 2019-10-29-css居中情况不完全整理
date: 2019-10-29 21:01:48
tags: middle css float margin
categories: "2019-10"
---

## 整理集中 css 居中以及布局的情况

### 两列
    第一列定宽, 第二列不定宽的情况

    #### 思路

    第一列是定宽, 设置一个固定宽度
    第二列与第一列平行, 首先要设法让第二个元素与第一列存在同一行
    > 方法主要有内联(inline-block, float & 负margin)
    > 鉴于 负 margin 的兼容性比较好, 所以采用此种方法

    ```html
    <div class="left"></div>
    <div class="right"></div>

    .left ,.right {
        float: left;
    }

    .left{
        width: 100px;
    }
    .right {
        width: 100%;
        margin-left: -100px;
    }
    ```

    让第二个元素往左 "伸入" 100px; **我理解上认为这个时候 left 盖住了 right 的一部分**
    所以他们可以在同一行. 然后 right 中可以放入实际的 右侧的非固定宽度的元素

    ```html
    ...
    <div class="container" >
        <div class="left"></div>
        <div class="right">
            <div class="real-right"></div>
        </div>
    <div>

    ...

    .container{
        width: 100%;
    }
    .left{
        width: 100px;
    }
    .right {
        width: 100%;
        margin-left: -100px;
    }

    .real-right{
        margin-left: 100px;//可以进一步修改, 让 中间有一些隔离效果.
    }
    ```

### 三列

    两边定宽, 中间不定宽的情况

    同以上的思想, 只是增加了一个右侧的固定宽度.

    代码如下

    ```html
    <body>
        <div class="left">left</div>
        <div class="middle"><div class="real-middle">middle</div></div>
        <div class="right">right</div>

        <style>
            .left, .right, .middle{
                float: left;
            }
            .left {
                width: 100px;
                border: 1px solid #000;
            }

            .right {
                width: 100px;
                border: 1px solid #000;
            }

            .middle{
                width: 100%;
                margin-left: -102px;
                margin-right: -102px
            }

            .real-middle{
                margin-left: 110px;
                margin-right: 110px;
                border: 1px solid #000;
            }
        </style>
    </body>
    ```


