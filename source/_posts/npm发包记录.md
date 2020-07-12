---
title: npm发包记录
date: 2020-07-12 11:15:06
tags: npm
---

npm 可以方便的发布自己的包, 由于公司有自己的私服 npm 服务器, 并且自己并不参与实际的发包工作.
所以很长时间对发包的事情没有清晰的认识, 其实搞清楚之后发现是非常简单的.

说一下在 `npmjs.org` 上发包的流程.
1. 首先需要有 npmjs 的账户
2. 更改自己的 npm 的源为 npmjs.org, 具体搜索一大推, 可以安装 `nrm`
3. 在当前需要发布的包下边执行命令
```shell
npm add user xxx
npm login
```
4. 然后执行 `npm publish`即可, 注意更改版本号

注意需要发包之前更改下版本号, 可以通过命令

比如版本号为 1.1.1

```shell
npm version major # 更改为 2.1.1
npm version minor # 更改为 2.2.1
npm version patch # 更改为 2.2.2
npm version prepatch # 更改为 2.2.2-0
```
具体详细的可以参考版本命令遵守的规则 [语义化版本](http://semver.org/lang/zh-CN/)


