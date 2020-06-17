---
title: 2019-10-30-second-largest-element
date: 2019-10-30 09:30:51
tags:
categories: "algorithm"
---

## 获取第二大的元素

> 思路: 获取第二大的元素, 即从所给的元素中获取第二大的元素, 尽量最小的思路去获取
> 第二大, 那就只有一个元素比我大, 如果有2个比我大的, 那么就 break; 否则你就是第二大的.
> 两次按照条件的循环遍历

```javascript

//需要两次遍历的方法
function getSecond(elements){

    let secondLargestElement;
    for(let outerIndex = 0; outerIndex < elements.length; outerIndex++){
        secondLargestElement = elements[outerIndex];
        let count = 0;
        for(let innerIndex = 0; innerIndex < elements.length; innerIndex++){
            const item = elements[innerIndex];
            if (item > secondLargestElement) {
                count ++ ;
            }
            //如果有2个比我大的, 那么 break;
            if (count >= 2) {
                break;
            }
        }
        //循环一次后, 只有一个比我大的, 那么说明就是这个元素
		if (count === 1) {
			return secondLargestElement;
		}
    }
    return secondLargestElement;
}
```

> 有没有一次遍历就可以达到目的的方法呢, 我想应该有...
> 思路: 一般这样的节省一次循环的, 需要额外的空间, 引入map进行辅助.
> 将最大的取出, 然后第二次取最大的.

```javascript
function getSecondMax(arr) {
    const max = Math.max(arr);
    const index = arr.indexOf(max);
    const leftArr = arr.splice(index, 1);
    return Math.max(leftArr);
}

```

> 通过万能的谷歌兄弟, 查找一下看看,
> 思路: 通过 max 进行辅助, 将 max 和 second 以及比较对象之间进行比较, 可以通过一次遍历进行查找到第二大的算.

```javascript
function findSecondByOnce(arr) {
    if (!arr || arr.length < 2) {return false;}
    let max, second;
    //先随机指定最大和第二大元素
    if (arr[0] > arr[1]){
        max = arr[0];
        second = arr[1];
    }
    else {
        max = arr[1];
        second = arr[0];
    }
    //通过一次遍历, 更改第一和第二大的元素即可
    for(let index = 2; index < arr.length; index++){
        const item = arr[index];
        //比最大的大了, 那么最大的和第二大的要进行改变
        if (item > max) {
            second = max;
            max = item;
        }
        else {
            //比最大的小, 但是如果比第二大的大, 那么需要改变第二大的元素
            if (item > second) {
                second = item;
            }
        }
    }

    return second;
}
```
