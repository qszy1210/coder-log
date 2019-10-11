#!/bin/sh

hexo deploy --generate;
rm -rf qingsong
rm -rf tech
mv public tech