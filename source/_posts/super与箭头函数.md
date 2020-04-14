---
title: super与箭头函数
tags: function arrow
date: 2020-04-14 08:55:30
---


引子: 遇到以问题, super 调用的时候说找不到.
查看父类, 的确有这个方法的创建. 但是这个方法是箭头函数.

尝试了一下几种情况

1. 父类更改为 function 不可以, 编译与箭头函数相同的结果
2. 父类更改为 成员函数 可以, 编译后, 方法在 prototype 上
3. 父类箭头函数 不可以, 原因: 需要在子类中进行 call 调用,因为为箭头函数, 传入的 this 将无效. 并且编译后的代码, 也不是 prototype 上的, 而是在 方法内部进行的处理.

确认的话, 还是要查看最终编译后的方法才行
1,3 的情况编译后的代码, 如果原方法如下

```js
class Father {
    methoda = function () {
        return 'methoda'
    }
}

class Son extends Father {
    callMethod = function (){
        super.methoda(); //not found
    }
}
```

编译后的方法

```js
function Father(){
    var _this = super.call(this) || this;
    _this.methoda = function () {
        return 'methoda';
    }
}
...
```

如果是成员函数的声明, 原方法

```js
class Father {
    methoda = function () {
        return 'methoda'
    }
}

class Son extends Father {
    callMethod(){
        super.methoda(); //not found
    }
}
```

编译后

```js
function Father(){
    var _this = super.call(this);
}

Father.prototype.methoda = function() {
    return 'methoda';
}
...
```

而子类在找父类的时候, 就是采用的 prototype 上的方法进行的.

挂一个参考地址: https://www.cnblogs.com/smdb/p/10185886.html