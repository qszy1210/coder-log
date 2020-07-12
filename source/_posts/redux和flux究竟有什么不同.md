---
title: redux和flux究竟有什么不同
date: 2020-07-12 11:27:59
tags: redux flux
---

一直都说 redux 是 inspired by  flux, 也就是说基本上这两个是差不多的. redux 是遵循 flux 思想开发的一个
react 的状态管理库.

那么我们或者说大家都还是有很多说这两个地方到底有什么不同的地方. 对此我也有自己的一个理解, **理解成了自己的东西才真正是自己的东西**

1. flux 基本构成的几大块  `store` `dispatch` `action` `vm(view)`
   说 dispatch 是运转的核心, 其实就是通过 dispatch 去驱动整个的数据流转.
   说触发关系之前, 有几个监听需要注明

   (1) 首先 store 注册(其实就是监听的意思) 了 dispatch 上的事件变化,
   view 中监听了 store 的变化.
   (2) 然后 dispatch 变化后, store 进行相应, 然后 trigger(emit, 抛出事件) 变化以供 view 变化
   view 中有监听了 store 的变化, 然后 view 中触发具体的 render 方法(react , vue 中等等 )

   核心思想:
   更改 store 中的数据一定是通过 dispatch 发送一个 action 来进行实现, **复杂(或者说规则明确)了, 却能带来长久的规定与后续的清晰**
   这样也能说明是数据的单项流动.

   这其中并没有规定只有一个 store, 这个 store 也只是 data, 并不是状态, 具体的 state(状态) 与 store 的绑定在 view 这一层.
   view 中有具体的响应,  store 这里只是把变更发送了出去.
   `action` 在这里可以理解为事件处理, 通过 action 提供接口供 view 层去调用, **action 中调用 dispatch去触发具体的事件**
   或者把  action 整理理解为一个 **事件的派发**, 最终是要改变 store

   或者可以说 flux 只是一个指导思想. 规定数据的单项流动, 更改数据必须走统一的规则 (dispatch)

2. redux 基本构成 `store`  `dispatch`  `reducer`
   redux 在 flux 的思想上, 又进一步的约束.
   1. 只有一个 store
   2. 函数式编程(reducer), 可以对结果进行预测, redux 的 `r` 就是 reducer
   3. 改变 store 方式唯一(即只有 store 中的 reducer 能够进行更改)

    其实 redux 对 flux 的限制只是限制了 只有一个 store, 并且严格约束函数式编程范式.

    其中的 store 就是根据 reducer 进行生成的, 并且 dispatch 方法也是 从 store 中返回

    一切都围绕着这一个 store.

    数据流程:  **store 中 dispatch action 后, 派发到对应的 reducer 处理, 然后返回对应的 新状态.**

扩展: 围绕此基础上又提供了一些功能加强
    1. 比如 middware 加强了 dispatch 方法, 默认 dispatch 是只能接受一个 action 对象
    2. replaceReducer, combineReducer 可以认为是对 reducer 的加强
    3. immutable 等不可变, 是提高性能, 也算是对 store 的数据加强

3. redux-react, 与 react 的结合属于单独的一部分, 只简单说一下
   原理: **使用 connect 和 provider, 通过 react 中提供的 context 实现了 state 与 store 的连接**.

总结:
 目前项目中主要使用 `mobx` 在做状态管理, 上边只是按照自己的理解进行了梳理.  redux 在大型项目中的确非常有用,
 清晰的数据处理, 对于多人协作是非常有好处的. mobx 快速, 却也让我们 **不明事理**, 但是人家的初衷就是让你 **不用明事理**...


