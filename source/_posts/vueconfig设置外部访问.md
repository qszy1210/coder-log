---
title: vueconfig设置外部访问
date: 2021-01-04 20:50:58
tags: vueconfig vue-cli
---

## vueconfig设置外部访问

在 vue-config 中 devServer 中增加配置

配置如下

```js
...
devServer: {
    host: '0.0.0.0',
    port: port,
    disableHostCheck: true // 此处也要设置为 true
}
...
