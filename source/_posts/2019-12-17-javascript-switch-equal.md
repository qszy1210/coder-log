---
title: javascript-switch-equal
tags: switch javascript
date: 2019-12-17 19:25:46
---


## swith case 的一个注意点

见如下

```javascript
switch (target){
    case '1':
    break;
    case '2':
    break;

    default: break;
}
```

这里有两个注意点: 其中的 `case '1'`, 如果 target 等于 1 会匹配么?

又如下

```javascript
switch (target){
    default: break;
    case '1':
    break;
    case '2':
    break;

}
```

如果 `default` 的位置在最上边, 会首先执行么?


结果当然一运行便知晓:


### 结论

1. case 中的匹配是全等 `===` 匹配
2. default 不管位置, 会在最后进行执行
