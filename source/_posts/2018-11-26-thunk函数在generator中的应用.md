---
title: thunk函数在generator中的应用
date: 2018-11-26 19:51:22
tags:
---


## thunk函数在generator中的应用

首先 thunk 搜索的时候, 似乎就是一个计算机术语. thunk 被翻译为"形实转化程序",其实可以理解为一个转化程序
所以, js 中的 thunk 就是将 generator 函数进行转化, 以便能方便的进行使用.

1. 应该接收一个 generator 函数
2. 返回一个函数, 由于是异步的, 所以这个函数中应该返回一个 promoise
3. 由于是自动执行, 所以, 会遍历所有的 next 的执行, 所以会有一个递归调用

```js
function thunk(gen) {
    const iter = gen();
    let next = null;
    return function handleNext(data){
        next  = iter.next(data);
        if (!next.done) {
            return Promise.resolve(next.value).then(data=>{
                return handleNext(data);
            })
        }
        else {
            return Promise.resolve(data);
        }
    }
}

```

一个增加错误处理的版本(摘自 <你不知道的JavaScript>)

```js
function run(gen) {
    var args = [].slice.call(arguments, 1),
        it;
    // 在当前上下文中初始化生成器
    it = gen.apply(this, args);
    // 返回一个promise用于生成器完成
    return Promise.resolve()
        .then(function handleNext(value) { // 对下一个yield出的值运行
            var next = it.next(value);
            return (function handleResult(next) { // 生成器运行完毕了吗?
                if (next.done) {
                    return next.value;
                }
                // 否则继续运行
                else {
                    return Promise.resolve(next.value)
                        .then(
                            // 成功就恢复异步循环，把决议的值发回生成器
                            handleNext,
                            // 如果value是被拒绝的 promise， // 就把错误传回生成器进行出错处理
                            function handleErr(err) {
                                return Promise.resolve(
                                        it.throw(err)

                                    )
                                    .then(handleResult);
                            }
                        );
                }
            })(next);
        });
}
```
