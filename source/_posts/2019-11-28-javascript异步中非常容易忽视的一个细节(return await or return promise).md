---
title: 2019-11-28-javascript异步中非常容易忽视的一个细节(return await or return promise)
date: 2019-11-28 07:30:25
tags: [javascript, async await, promise]
categories: "2019-11"
---

闲话少说, 先上代码

```javascript
//一个很简单的通过promise实现的一个3秒后处理的逻辑
async function timeout(value) {
    return await new Promise(function(rel, rej){
        //三秒后进行处理
        setTimeout(function(){
            rel('ok')
        }, value);
    })
}
//2秒后输出 ok
timeout(2000).then(data=>{
    console.log(data);
})

```

对于以上的代码, 很容易得出输出

```javascript
ok
```

以上有2中情况的处理,

1. 如果我去掉 `return` 会有什么现象呢?
2. 因为默认 async 返回的就是一个 promise, 所以 await 我可以不写.

```javascript
//去掉 return
//一个很简单的通过promise实现的一个3秒后处理的逻辑
async function timeout(value) {
    //去掉此处的 return
    //return
    await new Promise(function(rel, rej){
        //三秒后进行处理
        setTimeout(function(){
            rel('ok')
        }, value);
    })
}

//2秒后输出undefined, 两秒的效果还是有的
timeout(2000).then(data=>{
    console.log(data);
})

```

```javascript
//去掉 await
//一个很简单的通过promise实现的一个3秒后处理的逻辑
async function timeout(value) {
    //去掉此处的 await
    return new Promise(function(rel, rej){
        //三秒后进行处理
        setTimeout(function(){
            rel('ok')
        }, value);
    })
}

//两秒后输出 ok
timeout(2000).then(data=>{
    console.log(data);
})

```

```javascript
//都去掉
//一个很简单的通过promise实现的一个3秒后处理的逻辑
async function timeout(value) {
    //return 和 await 都去掉
    new Promise(function(rel, rej){
        //三秒后进行处理
        setTimeout(function(){
            rel('ok')
        }, value);
    })
}

//立即输出 undefined
timeout(2000).then(data=>{
    console.log(data);
})

```

## 结论

1. 通过以上可以得出结论 async 默认需要返回一个 promise, 这样在 .then 中的 data 参数会默认接收到前边 promise 的结果, 如果是 reject 当然是到 catch 中去了.
2. 如果不返回, 那么默认其实就是返回一个 undefined, 被 then 接收到的就是 undefined 了.
3. 如果不返回, 只有 await, 由于 await 的作用, 让然会等到 resolve 执行后, 才去执行 then, 但由于 *没有返回值*, 所以 then 接收的也是 undefined
4. 也可以直接返回一个 promise, 会在 promise fullfill 状态后进行后续处理(包括 resolved 或者 rejected)
5. 注意直接 `new Promise(rel=>rel('ok')).then...` then 是接收promise直接 resolve 的结果的.
