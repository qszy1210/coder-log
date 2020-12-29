---
title: electron项目安装慢的问题
date: 2020-12-29 19:54:43
tags:
---

## electron 安装慢的问题


运行 `[electron-quick-start](https://github.com/electron/electron-quick-start)` 项目的时候

```shell
npm i
```

一直提示下载中, 如下

```shell

> node install.js

Downloading electron-v11.1.1-darwin-x64.zip: [--------] 2% ETA: 14641.4 s
```

遥遥无期,

可以通过 taobao 的镜像直接进行下载,
如下: https://npm.taobao.org/mirrors/electron

选择自己的版本进行下载, 然后将下载包(zip包和对应 SHA 文件, SHA 文件需要增加版本号)放在目录
比如我下载的为 v11.1.1 版本, 那么 SHA 文件名为 `SHASUMS256.txt-11.1.1`

`~/.electron/` 目录下, 然后再次执行

```shell
npm i
```

## 但是

仍然提示会去进行安装, 有的说需要将下载的安装包放在目录  `~/Library/Caches/electron/` 下

尝试后仍然不行,

一个比较好的执行方法是, 单独在包下边安装

```shell
ELECTRON_MIRROR="https://cdn.npm.taobao.org/dist/electron/" npm install electron
```

亲测可用.

然后再次执行, 即可

```shell
npm i

npm start
```

即跑通了.

### 后记

其实可以直接执行

```shell
ELECTRON_MIRROR="https://cdn.npm.taobao.org/dist/electron/" npm install
```

并且安装后会在目录 `~/Library/Caches/electron/` 下新建一个文件夹 `httpscdn.npm.taobao.orgdistelectronv11.1.1electron-v11.1.1-darwin-x64` 和 `httpscdn.npm.taobao.orgdistelectronv11.1.1SHASUMS256` 分别放上边说的文件