#!/bin/sh

hexo deploy --generate;
rm -rf qingsong
mv public qingsong