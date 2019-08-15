---
title: 2019-08-01-souretree-cli
date: 2019-08-01 14:28:11
tags: sourcetree cli vscode webstorm
---

## sourecetee cli

sourcetree 增加命令行支持

可以设置 alias

```shell
alias sourcetree='open -a SourceTree'

```

然后

```shell
SourceTree /open/your/git/repo/path
```

或者直接安装命令行支持, 直接执行

```shell
stree /open/your/git/repo/path
```

参考链接 [参考链接](https://community.atlassian.com/t5/Sourcetree-questions/How-do-I-open-a-repository-in-SourceTree-from-the-commandline/qaq-p/437587)
[安装包下载](http://downloads.atlassian.com/software/sourcetree/SourceTreeAppStoreCmdLineToolInstaller.pkg?_ga=2.74726298.901736220.1564640820-2134789913.1548654902)

## vscode

- Launch VS Code.

- Open the Command Palette (⇧⌘P) and type 'shell command' to find the Shell Command: Install 'code' command in PATH command.

- Restart the terminal for the new $PATH value to take effect. You'll be able to type 'code .' in any folder to start editing files in that folder.

简单解释下, 就是通过 command + shift + p 命令行进行安装支持

[参考链接](https://code.visualstudio.com/docs/setup/mac)

## webstore 的cli支持

只记录mac下的方式, 其他的参考链接

- From the main menu, select Tools | Create Command-line Launcher

- In the **Create Launcher Script** dialog that opens, type the name of the launcher and the path to it, or accept the suggested default value webstorm.

- Outside WebStorm, add the path and the name of the launcher script to your path.

解释: 其实就是webstorm给增加一个启动的快捷, 可以接受目录的传递. 然后将这个 启动app 增加进 path, 不过默认就是在 ```/usr/local/bin``` 下,所以一般不需要增加

[参考链接](https://www.jetbrains.com/help/webstorm/working-with-the-ide-features-from-command-line.html)
