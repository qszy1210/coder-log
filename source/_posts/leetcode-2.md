---
title: leetcode-2
date: 2020-04-30 09:46:52
tags: leetcode
categories: "algorithm"
---
## leetcode-2 自己的无参考实现

```js
/**
 * Definition for singly-linked list.
 * function ListNode(val) {
 *     this.val = val;
 *     this.next = null;
 * }
 */
/**
 * @param {ListNode} l1
 * @param {ListNode} l2
 * @return {ListNode}
 */

function ListNode(val) {

  this.val = val;
  this.next = null;

}

ListNode.prototype.insert = function (val) {
  if (this.val === undefined) {
    this.val = val;
    return;
  }

  var node = new ListNode(val);
  var cur = this;
  while (cur.next) {
    cur = cur.next
  }
  cur.next = node;

}

var l1 = new ListNode(3);
for (var i = 5; i < 9; i++) {
  l1.insert(i)
}

var l2 = new ListNode(5);
for (var i = 1; i < 7; i++) {
  l2.insert(i)
}


var addTwoNumbers = function (l1, l2) {
  if (!l1.val && l2.val) return l2;
  if (!l2.val && l1.val) return l1;
  if (!l1.val) return l2;

  var cl1 = l1,
    cl2 = l2;
  var l3 = new ListNode();
  var addOneFlag = false;
  while (cl1 || cl2) {
    var cval = (cl1 && cl1.val || 0) + (cl2 && cl2.val || 0);

    var l3val = (cval >= 10 ? cval - 10 : cval) + (addOneFlag ? 1 : 0);

    if (cval > 10) {
      cval -= 10;
      addOneFlag = true;
    } else {
      addOneFlag = false;
    }

    if (cl1)
      cl1 = cl1.next;
    if (cl2)
      cl2 = cl2.next;
    l3.insert(l3val)


  }

  return l3;
};

var l3 = addTwoNumbers(l1, l2);
var l3arr = [];
var cur = l3;
while (cur) {
  l3arr.push(cur.val);
  cur = cur.next;
}
console.log(l1);
console.log(l2);
console.log(l3);
console.log(l3arr);
```
