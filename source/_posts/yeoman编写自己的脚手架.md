---
title: yeoman编写自己的脚手架
date: 2020-07-21 23:56:09
tags: yeoman
---

在 gulp 时代, 就开始有使用 [yeoman](https://yeoman.io/), 感觉是一个特别方便的脚手架.

在使用 `angularjs` 的时候, 经常用这个脚手架生成一些小东西去学习

在有了 `create-react-app` 这个命令之后, 似乎很少开始接触 yeoman.

yeoman 上有一个比较完善的学习教程 (getStart)[https://yeoman.io/authoring/index.html]

但是突然想到有没有 generator 的 generator ?

果然有. 操作命令如下

```shell
npm install -g generator-generator # 安装generator
mkdir bsqy && cd $_ # 新建并进入文件夹
yo generator #执行安装的generator, 输入一些自己的内容. 等待一些时间
# 生成按照你命令的名字, 比如 qs 的一文件夹  generator-qs
#进入文件夹
cd generator-qs
npm link # 让 yo 可以发现你
yo qs # 会创建一个 dummyfile.txt 文件, 并还行一些事情...


```

主要是看一下 目录下 `generator/app/index.js` 中的内容

```js
module.exports = class extends Generator {
  prompting() {
    // Have Yeoman greet the user.
    this.log(
      yosay(`Welcome to the brilliant ${chalk.red('generator-bsqy')} generator!`)
    );

    const prompts = [
      {
        type: 'confirm',
        name: 'someAnswer',
        message: 'Would you like to enable this option?',
        default: true
      }
    ];

    return this.prompt(prompts).then(props => {
      // To access props later use this.props.someAnswer;
      this.props = props;
    });
  }

  writing() {
    this.fs.copy(
      this.templatePath('dummyfile.txt'),
      this.destinationPath('dummyfile.txt')
    );
  }

  install() {
    this.installDependencies();
  }
};
```

其中有 提醒, 有写入创建文件, 有安装要执行的过程, 可以说达到了一个良好代表的标准了 `自解释`


总结: 了解 yeoman 的快速上手, 可以快速的创建一些自己需要的模板, 如果有必要的话.


