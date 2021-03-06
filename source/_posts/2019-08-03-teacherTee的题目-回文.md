---
title: 2019-08-03-teacherTee的题目-回文
date: 2019-08-03 17:00:37
tags: 回文 面试
categories: "algorithm"
---

# 一个关于回文的面试题目

题目如下:
给定一个字符串s，你可以从中删除一些字符，使得剩下的串是一个回文串。如何删除才能使得回文串最长呢？
输出需要删除的字符个数
例如: 比如 abcdba 那么删除掉d以后就是回文字符串了 😁

这个题目直接就是赤裸裸的考察**动态规划算法**的, 对于这个算法, 我只能不好意思重新看了,
见链接, 感觉这个up主写的特别好, 赞赞赞
[动态规划算法](https://blog.csdn.net/hrn1216/article/details/51534607)

理解了这个算法, 这个题目就很好解决了. 解决方法如下:

```js
function lcs(a, b) {
  //a,b 的公共子序列长度, 最长只能是a和b的长度
  //我们认为 r[i][j] 中 i 为 a 中的子序列长度, j 为 b 中的子序列长度
  //所以在i,j为0的时候, 即子序列(我们的回文长度)长度为0的时候, 我们的公共子序列长度肯定也为 0
  //r[i][j] 就可以理解为一个记录本, 记录长度为i的a和长度为j的b
  //因为采用的是动态规划法, 所以我们统计 a 和 b的时候, 就假设从 a 和 b 长度为0开始计算, 所以才有上边的说法
  var r = {};
  for (var i = 0; i <= a.length; i++) {
    r[i] = r[i] || [];
    r[i][0] = 0;
  }
  for (var j = 0; j <= b.length; j++) {
    r[0] = r[0] || [];
    r[0][j] = r[0][j] || 0;
  }

  //之所以 <= 是因为我们的i和j为实际的子序列的长度, 子序列的长度为 0 到 4 的
  for (var i = 1; i <= a.length; i++) {
    for (var j = 1; j <= b.length; j++) {
      //如果有相同的, 那么公共子序列的长度肯定包含这个相同的子项
      //我们的公共子序列 = 其他的公共子序列 + 1 (这一个相同的)
      if (a[i] === b[j]) {
        r[i] = r[i] || [];
        r[i][j] = (r[i - 1][j - 1] || 0) + 1;
      } else {
        //如果不相同, 那么我们就取位数少一个的最大值
        //a 和 b 不一定相同, 所以我们即取 a 或者 b 中的 i 和 j 长度时候的最大值
        r[i] = r[i] || [];
        r[i][j] = Math.max(r[i][j - 1] || 0, r[i - 1][j] || 0);
      }

    }
  }
  return r;

}

//比如 abcdd123cba
const a = 'abcdd123cba';
const b = a.split('').reverse().join('');
const len = a.length;
const maxlcsLength = (lcs(a,b))[len][len];
```

有最大长度为 maxlcsLength 的公共子序列, 那么要删除的自然就知道了.~
即
``` len - maxlcsLength // 3 ```
