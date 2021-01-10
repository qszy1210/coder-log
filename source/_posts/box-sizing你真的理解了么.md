---
title: box-sizing你真的理解了么
date: 2021-01-08 19:38:44
tags:
---

## box-sizing你真的理解了么

面对这个问题, 似乎上来的回答就是: **yes**

因为这个 属性只有2个值

```css
box-sizing: border-box;
box-sizing: content-box;
```

当你设置宽度的时候
 `border-box` 即表示宽度包含 border, 即 width = border-width + padding-width + content-width
 `conent-box` 即表示宽度不包含 border, 即 width = padding-width + content-width

似乎问题就到这里了, 并且大家很多的时候也非常非喜欢用 `border-box`, 因为当你设置 `border-box` 的时候,
调整宽度, 或者 border 不会影响到外部, 继而不会出现很多问题.

> 我也认为这个就是全部了.写到这里我突然也发现有些不对
> 或许写一些博客(笔记)就可以让自己进一步的理解我遇到的问题

我遇到的问题就是 background-clip 的问题

**当你的 border 是 `border-box` , 你的 `content` 的区域其实会随着 border 或者 padding 而有所变化的**

所以, 当我设置一个具体的 用 `css 去制作一个menu图形`的时候就遇到了一些小问题


但是你的 `background-clip` 是 `content-box`的时候

实现代码如下

```html

<div class="menu-icon"></div>

<style>
.menu-icon {
    display: inline-block;
    width: 16px;
    height: 2px;
    padding: 5px 0;
    background-clip: content-box; /*这个地方设置一定要有*/
    background-color: #fff;
    border-width: 2px 0;
    border-style: solid;
    border-color: #fff;
    vertical-align: middle;
}
</style>

```

如果这个时候 `box-sizing: border-box`, 那么我的内容其实就没有了.
所谓的 `background` 的内容就没有效果了.

附:

background-clip属性, 有三个属性
    background-clip: border-box;
    background-clip: content-box;
    background-clip: padding-box;

具体的见 [mozilla](https://developer.mozilla.org/en-US/docs/Web/CSS/background-clip)


所以要注意在一些不同属性之间的相同内容的场景.


