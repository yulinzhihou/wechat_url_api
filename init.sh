#!/usr/bin/env bash
# author:yulinzhihou@gmail.com
# 用于初始化项目
composer install
php think migrate:run
