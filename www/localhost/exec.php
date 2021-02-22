<?php
// 用户提交的POST参数
$name = "cat /proc/sys/kernel/random/uuid";
echo exec($name);
