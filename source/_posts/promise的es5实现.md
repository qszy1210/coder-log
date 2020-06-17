---
title: promise的es5实现
tags: promise
date: 2018-11-21 22:58:54
categories: "javascript"
---


## promise 的 es5 实现

首先要理解promise的几个关键点

### 思想:
状态三种: pending reject resolve
then返回的是新的promise
then的方法中必须要有返回值, 下一个链式的 then 才能够接收到.
直接的 promise 实例, 可以直接 then, then 会接收 resolve 或者 reject 的结果.

伪实现:
状态属性 status

resolve, reject 对状态进行更改;

then 接收 resolve 或者 reject 的结果;

### 伪实现:

```js
function pp (callback) {
    var status = 'pending';
    function resolve(data) {
        status = 'resolved';
    }
    function reject(error) {
        status = 'reject';
    }
    callback(resolve, reject)
}

pp.prototype.then = function (resolveFunc, rejectFunc) {
    var data; // resolve 的结果
    var error;//reject 的结果
    var thenResult = resolveFunc(data);
    //rejectFunc(error);
    return new pp();
}

```

### 疑点:(其实一点都没解决这个问题)

1. 怎么解决实例化的时候, 外部方法传入的时候, 将 rel, rej 进行传入的问题 function(rel, rej){}
2. 怎么解决状态传递的问题
3. 怎么解决data传递问题

### 回答我的疑问:

1. 首先要说的是没有确切明白 promise 中的各个的用法,以及哪些方法是要方法自身提供, 哪些方法是外部提供的.
虽然使用的时候感觉不到什么, 但是实现的时候却是要非常清楚的.

比如 Promise 的构造方法

```js
new Promise(function(rel, rej){
    rel('ok')
})
```

这其中的 rel 和 rej 是 Promise 提供的, 而其中的 'ok' 的结果是外部传入的.
这其中的整个方法 function(rel, rej){rel('ok)} 也是外部提供的

比如 then 方法

```js
Promise.resolve().then(data=>{
    ....
})
```

then 接收的方法是外部传入的, 但是这个 *data* 是 promise 提供的.

这些当然说起来很简单, 但是能够在编写的时候时刻注意, 时刻明确, 我认为不是一件容易的事情.

2. 状态的传递 以及 data 的传递.可以通过 promise 实例进行持有, 然后在 then, catch 等方法的时候进行转移.
而转移的方法通过更改当前的上下文, 有方法 bind, call, apply 都可以进行采用. 这里比较方便的是采用 call 进行转移

### 进一步实现, 在原来伪实现的基础上进行更改

```js
//这里真是伪实现-_-, 在无任何参考的情况下,想到了这里, 还是需要进一步的思考

//方法名称最好大写一下, 我们这个方法主要记录一下状态和数据
// function pp (callback) {
function PP (callback) {
    //stats因为需要进行传递, 所以绑定在 this 上, 状态我们制定为 三种 'pending' 'resolve' 'reject'
    //默认为 pending, 切换到 resolve 和 reject
    // var status = 'pending';
    this.status = 'pending';
    //用来记录正常流程处理的内容
    this.data;
    //用来记录error信息的
    this.error;

    var that = this;
    //内部提供这个方法, 但是这个 data 是外部提供的, 我们需要记录这个 data, 用于传递给以后的 实例
    //todo 对于如果传递的 data 是 Promise 类型的, 还需要进一步的进行处理为正常的对象或者平数据
    function resolve(data) {
        that.data = data;
        that.status = 'resolved';
    }
    function reject(error) {
        that.error = error;
        that.status = 'reject';
    }
    try {
        callback(resolve, reject)
    }
    catch(error){
        reject(error);
    }
}

//then 方法接收成功和失败的处理方法, 什么情况下接收成功和失败需要看 PP 中存储的是什么类型的内容,
//因为是通过 PP.prototype.  的形式进行调用, 所以我们能获取到 this
//但是需要注意返回的是一个新的 promise
// pp.prototype.then = function (resolveFunc, rejectFunc) {
PP.prototype.then = function (resolveFunc, rejectFunc) {
    // var data; // resolve 的结果
    // var error;//reject 的结果
    // var thenResult = resolveFunc(data);
    //rejectFunc(error);

    //需要根据promise的内容决定返回怎么样的promise
    var promise;
    var that = this;
    //如果 this.data 有内容, 说明执行了成功的
    if (that.data) {
        promise = new PP(function(rel){
            //因为then是异步的函数, 所以增加一个 setTimeout
            setTimeout(function(){
                //后续的promise会接收then的返回结果
                var thenResult = resolveFunc(that.data);
                rel(thenResult);
            })
        })
    }
    else if (that.error){
        promise = new PP(function(rel, rej){
            setTimeout(function(){
                var thenResult = rejectFunc(that.error);
                rej(thenResult);
            })
        })
    }

    //返回一个新的promise
    // return new pp();
    return promise;
}

//catch 方法接收前边的error方法, 其实就是一个 只有 reject 的 then
//这里直接把上边的 then copy 一半过来
PP.prototype.catch = function(error) {
    //需要根据promise的内容决定返回怎么样的promise
    var promise;
    var that = this;
    //如果 this.data 有内容, 说明执行了成功的
    if (that.error){
        promise = new PP(function(rel, rej){
            setTimeout(function(){
                var thenResult = rejectFunc(that.error);
                rej(thenResult);
            })
        })
    }

    //返回一个新的promise
    // return new pp();
    return promise;
}

```

### 简单的一个测试

```js
var aa=new PP(function(rel,rej){rej('ok123')});
aa.then(function(d){console.log(d)}, function(error){console.log(error)});
```

### 进一步完善

#### 引子

 看起来挺好的一个实现, 其实问题很多. 首先既然是 promise 肯定存在一个 pending的中间状态.
我这里默认的是直接将 pending 设置为了 resolve(fulfilled) 状态, 失去了 promise 的意义.
这样 then 直接执行, 接收的是 上一个 promise 的 data 和 status, 但是这里由于异步所以接收不到了.

所以我们需要有一个机制去完成这个记录工作,并且在需要执行的时候进行执行, 并且then 还能够接收到.

如果then这个时候接收到的是 pending 的说明还没有执行, 那么就进行一下记录, 让 promise 在执行 resolve 的时候
再进行执行.

#### resolve 的 promise 问题

如果 resolve 接收的是一个 promise, 那么还需要进一步的执行 then 方法, 得到最后的结果(此处省略)

如下代码

```js
//这里真是伪实现-_-, 在无任何参考的情况下,想到了这里, 还是需要进一步的思考

//方法名称最好大写一下, 我们这个方法主要记录一下状态和数据
// function pp (callback) {
function PP (callback) {
    //stats因为需要进行传递, 所以绑定在 this 上, 状态我们制定为 三种 'pending' 'resolve' 'reject'
    //默认为 pending, 切换到 resolve 和 reject
    // var status = 'pending';
    this.status = 'pending';
    //用来记录正常流程处理的内容
    this.data;
    //用来记录error信息的
    this.error;

    //>>>>>>>>>>>>>>>>>>>>>>>>> 增加内容
    //对应下边的增加, 这里需要增加声明
    this.toExecuteResolve = [];
    this.toExecuteReject = [];

    //<<<<<<<<<<<<<<<<<<<<<<<<<

    var that = this;
    //内部提供这个方法, 但是这个 data 是外部提供的, 我们需要记录这个 data, 用于传递给以后的 实例
    //todo 对于如果传递的 data 是 Promise 类型的, 还需要进一步的进行处理为正常的对象或者平数据
    function doResolve(data) {
        that.data = data;
        that.status = 'resolved';
    }

    function resolve(data) {
        if (that.status !== 'pending') return;
        if (that.toExecuteResolve && that.toExecuteResolve.length) {
            that.toExecuteResolve.forEach(function(relFunction){
                //执行 then 里边的逻辑
                var thenResult = relFunction(data);
                doResolve(thenResult);
            });
            that.toExecuteResolve = [];
        }
    }


    function doReject(error) {
        that.error = error;
        that.status = 'reject';
    }

    function reject(error) {
        if (that.toExecuteReject && that.toExecuteReject.length) {
            that.toExecuteReject.forEach(function(rej){
                var thenResult = rej(error);
                doReject(thenResult);
            });
            that.toExecuteReject = [];
        }
    }

    try {
        callback(resolve, reject)
    }
    catch(error){
        reject(error);
    }
}

//then 方法接收成功和失败的处理方法, 什么情况下接收成功和失败需要看 PP 中存储的是什么类型的内容,
//因为是通过 PP.prototype.  的形式进行调用, 所以我们能获取到 this
//但是需要注意返回的是一个新的 promise
// pp.prototype.then = function (resolveFunc, rejectFunc) {
PP.prototype.then = function (resolveFunc, rejectFunc) {
    // var data; // resolve 的结果
    // var error;//reject 的结果
    // var thenResult = resolveFunc(data);
    //rejectFunc(error);

    //需要根据promise的内容决定返回怎么样的promise
    var promise;
    var that = this;

    //>>>>>>>>>>>>>>>>>>>>>>>>> 增加内容
    //验证状态
    var status = that.status;

    //仍然是pending状态, 那么不进行执行, 将状态进行存储
    if (status === 'pending') {
        that.toExecuteResolve.push(resolveFunc);
        that.toExecuteReject.push(rejectFunc);
    }

    //<<<<<<<<<<<<<<<<<<<<<<<<<

    //如果 this.data 有内容, 说明执行了成功的
    if (that.data) {
        promise = new PP(function(rel){
            //因为then是异步的函数, 所以增加一个 setTimeout
            setTimeout(function(){
                //后续的promise会接收then的返回结果
                var thenResult = resolveFunc(that.data);
                rel(thenResult);
            })
        })
    }
    else if (that.error){
        promise = new PP(function(rel, rej){
            setTimeout(function(){
                var thenResult = rejectFunc(that.error);
                rej(thenResult);
            })
        })
    }

    //返回一个新的promise
    // return new pp();
    return promise;
}

//catch 方法接收前边的error方法, 其实就是一个 只有 reject 的 then
//这里直接把上边的 then copy 一半过来, 但是此处需要通过resolve进行接收
PP.prototype.catch = function(errorHandler) {
    //需要根据promise的内容决定返回怎么样的promise
    var promise;
    var that = this;
    //如果 this.data 有内容, 说明执行了成功的
    if (that.error){
        promise = new PP(function(rel, rej){
            setTimeout(function(){
                var thenResult = errorHandler(that.error);
                rel(thenResult);
            })
        })
    }

    //返回一个新的promise
    // return new pp();
    return promise;
}

```
