---
title: leetcode-3
date: 2020-04-30 13:42:51
tags:
---

## 获取最长字串

> 准备采用动态规划的方法进行处理

输入: "abcabcbb" 输出 cab 3
输入: ""pwwkew"" 输出 wke 3


```js
//这里获取到了最长子序列, 而不是子串, 这里输出了 pkew
function getLongestSubStr(s) {
    //s = s-1 + 1
    //s-1 = s-2 + 1
    if (!s || s.length < 0) return '';
    if (s.length ===1 ) return s;
    var s1 = s.charAt(s.length -1);
    var sleft = s.substring(0, s.length-1);
    var longest = getLongestSubStr(sleft);

    if (longest.indexOf(s1) === -1) {
        return longest + s1;
    }
    return longest;
}

getLongestSubStr("pwwkew")
```


```js
//获取最长子串
function getL(s) {
    if (!s) return '';
    var max = s[0];
    for(var i = 0;i<s.length; i++){
        var ss = sub(s, i);
        if (max.length < ss.length){
            max = ss;
        }
    }

    return max

}

function sub(s, i) {
    var sub = s.charAt(i);
    // while (i-1 > 0 && s.indexOf(s[i-1] + sub) > -1) {
    //     if (sub.indexOf(s[i-1]) ===-1){
    //         sub = s[i-1]+sub;
    //         i -= 1;
    //     }
    //     else {
    //     break;
    //     }
    // }
    while (i+1<s.length && s.indexOf(sub+s[i+1]) > -1) {
        if (sub.indexOf(s[i+1]) === -1){
            sub = sub+s[i+1];
            i += 1;
        }
        else {
            break;
        }
    }
    return sub;
}

getL("pwwkew")
```

执行时间 720ms, 需要继续优化, 我再想想.

```js
var getL = function(s){
if (!s) return 0;
var s1 = s[0];
var l = s.length;
var map = {};

map[s1] = 1;
map.count = 1;
var max = 1;
for(var i = 1; i<l; i++) {
    if (map[s[i]]) {
        if (max < map.count) {
            max = map.count;
        }
        s1 = s[i];
        map = {};
        continue;
    }
    s1 += s[i];
    map[s[i]]=1;
    map.count = (map.count||0) + 1
if (max < map.count) {
            max = map.count;
        }


}
return max;

}

getL('abc')
```