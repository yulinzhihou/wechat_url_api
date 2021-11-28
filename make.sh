#!/usr/bin/env bash
# author:yulinzhihou@gmail.com
# date : 2021-11-27
# 用于批量生成控制器，模型，验证器类。减少一个个手动创建或者复制,仅限于在开发时使用
if [ ! -f "think" ] && [ -d "./vendor/topthink" ]; then
    echo -e "请不要在网站目录以外的地方使用此命令"
else
  php think make:controller "$1"@v1/"$2"
  php think make:model "$1"@"$2"
  php think make:validate "$1"@"$2"
fi


