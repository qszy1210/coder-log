---
title: 2019-10-28-test-case-example
date: 2019-06-25 15:51:06
tags: karma
categories: "2019-10"
---

## 做一个前端迷你的测试 case

### 安装karma环境支持

```javascript
npm install -g karma
```

### 生成配置文件

```javascript
//执行以下命令, 根据选项进行生成
karma init my.conf.js
```

**主要注意点:**
basePath 设置为测试的根目录
files 支持通配符, 告诉 karma 要监听哪些文件的变化
测试库的配置, 默认 jasmine

### 启动环境

```javascript
karma start my.conf.js
```

### 编写测试用例

```javascript
//按照 jasmine 的格式进行测试用例的编写
describe("your-spec-name", function(){
    it("a-test-detail-name", function(){
      const yourAssertion = true;//code here
      expect(abc).toBe(true);
    })
})
```

### 后记

一个非常简单的自己的路线图, 配置环境只是一个辅助. 准备以后学习一下各种的 test case 的设置.
