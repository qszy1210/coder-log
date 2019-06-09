---
title: 'Object prototype may only be an Object or null: undefined'
date: 2019-06-06 14:23:29
tags: error
---

# Object prototype may only be an Object or null: undefined

在引用包的时候, 记录报错, 找了半天不知道什么原因.
到后来通过切换了两个包的引入位置, 而进行了解决.

即
```
import a from 'a';
import b from 'b';

//error Object prototype may only be an Object or null: undefined
```

fixed(途径):
```
import b from 'b';
import a from 'a';
```