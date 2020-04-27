---
title: 算法with-JavaScript
date: 2020-04-27 06:56:02
tags: algorithm javascript
---

## 通过一些场景学习一些算法学习

### 删除链表倒数第 n 个结点

给定一个链表，删除链表的倒数第 n 个节点，并且返回链表的头结点

给定一个链表: 1->2->3->4->5, 和 n = 2.
当删除了倒数第二个节点后，链表变为 1->2->3->5.

原来解答采用快慢指针的解法

```js
//添加 preHead 节点
var removeNthFromEnd = function(head, n) {
    let preHead = new ListNode(0)
    preHead.next = head
    let fast = preHead, slow = preHead
    // 快先走 n+1 步
    while(n--) {
        fast = fast.next
    }
    // fast、slow 一起前进
    while(fast && fast.next) {
        fast = fast.next
        slow = slow.next
    }
    slow.next = slow.next.next
    return preHead.next
};
```

```js
//单独处理倒数第 n 节点
var removeNthFromEnd = function(head, n) {
    let fast = head, slow = head
    // 快先走 n 步
    while(--n) {
        fast = fast.next
    }
    if(!fast.next) return head.next
    fast = fast.next
    // fast、slow 一起前进
    while(fast && fast.next) {
        fast = fast.next
        slow = slow.next
    }
    slow.next = slow.next.next
    return head
};
```

> 我的判断经过验证有些问题

感觉对倒数第几个的理解有歧义. 比如 倒数第1个, 即是最后一个.
如果长度为 3, [1,2,3], 那么倒数第3个即为第一个. 即 Head, 对于链表来说, 只用前进两次即到了最后一位.
判断此位置的 next 是否为 null 即可. 所以, 倒数第几个, 只需要前进 n-1 次即可.
修正

```js
var removeNthFromEnd = function(head, n) {
    let fast = head, slow = head
    // 快先走 n 步
    while(n--) {
        fast = fast.next
    }

    if(!fast) {
        // const preHead = new ListNode();
        // preHead.next = head;
        // preHead.next = head.next;
        return head.next;
    }

    //
    console.log('fast',fast.value)

    // fast、slow 一起前进
    while(fast && fast.next) {
        fast = fast.next
        slow = slow.next
    }
    slow.next = slow.next.next
    return head
};

function List() {
    this.head = null;
}

function ListNode(value) {
    this.value = value;
    this.next = null;
}

List.prototype.insert = function(value) {
    var node = new ListNode(value);
    if (!this.head) {
        this.head = node;
        this.head.next = null;
        return;
    }
    var head = this.head;
    while(head.next) {
        head = head.next;
    }
    head.next = node;
}

function log(list){
    var head = list.head;
    var arr = [];
    while(head){
        arr.push(head.value);
        head = head.next;
    }

    console.log(arr.join(','));
}

var list = new List();
for(var i = 0; i < 10; i++) {
    list.insert(i);
}

log(list);

//根据返回的 head 进行输出
var head = removeNthFromEnd(list.head, 3);
log(list);

while(head) {
    console.log(head.value);
    head = head.next;
}

```
