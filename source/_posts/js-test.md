---
title: js-test
date: 2020-05-22 15:51:21
tags: mocha chai karma
---

## 测试高频使用的库

### 1. mocha 测试库
比如

```javascript
describe('describe', function(){
    it('test-case-name', function(){

    })
})
```

### 2.chai 断言库

```javascript
const expect = require('chai').expect;
expect('a').to.be.a('string')
```

### 3.karma 测试集成库

```javascript
karma.config.js
```

