---
title: 2019-08-05-proxy-sample
date: 2019-08-05 21:07:30
tags:
categories: "javascript"
---

# 一个简单的proxy应用的例子

[参考网址](https://github.com/Advanced-Frontend/Daily-Interview-Question/issues/123)

```html

<body>
    hello,world
    <input type="text" id="model">
    <p id="word"></p>
  </body>
  <script>
    const model = document.getElementById("model")
    const word = document.getElementById("word")
    var obj= {};

    const newObj = new Proxy(obj, {
        get: function(target, key, receiver) {
          console.log(`getting ${key}!`);
          return Reflect.get(target, key, receiver);
        },
        set: function(target, key, value, receiver) {
          console.log('setting',target, key, value, receiver);
          if (key === "text") {
            model.value = value;
            word.innerHTML = value;
          }
          return Reflect.set(target, key, value, receiver);
        }
      });

    model.addEventListener("keyup",function(e){
      newObj.text = e.target.value
    })
  </script>

```