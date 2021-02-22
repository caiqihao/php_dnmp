<?php

// Redis连接对象
$redis = null;
// MySQL连接对象
$mysql = null;
// 客户端请求参数
$requestParams = [];


echo '---------------------------------先缓存后数据库---------------------------------';

// 删除缓存
$updateRedis = $redis->del('key');
if ($updateRedis) {
  // 更新MySQL
  $updateMysql = $mysql->update('update xxx set a=xx where id=xxx');
  if ($updateMysql) {
    return '数据更新失败';
  }
  // 回滚缓存(由于缓存删除失败，此时就不需要手动回滚。如果是执行的更新Redis，还需要手动回滚Redis)
  $redis->set('key', $requestParams);
}
return '缓存更新失败';


echo '---------------------------------先数据库后缓存---------------------------------';

// 更新MySQL
$updateMysql = $mysql->update('update xxx set a=xx where id=xxx');
if ($updateMysql) {
  // 更新缓存
  $updateRedis = $redis->set($requestParams);
  if ($updateRedis) {
    return '数据更新成功';
  }
  return '缓存更新失败';
}
return '数据更新失败';

echo '---------------------------------多线程同步---------------------------------';

// 线程一更新MySQL
$updateMysql = $mysql->update('update xxx set a=xx where id=xxx');
// 线程二更新缓存
$updateRedis = $redis->set('key', $requestParams);
if ($updateMysql && $updateRedis) {
  return '数据更新成功';
}
// 执行数据回滚
.....
return '数据更新失败';

echo '---------------------------------加锁处理---------------------------------';

// 客户端发起请求加锁
// 更新MySQL
$updateMysql = $mysql->update('update xxx set a=xx where id=xxx');
$updateRedis = $redis->set('key', $requestParams);
if ($updateMysql && $updateRedis) {
  // 释放锁
  // 返回信息
  return '数据更新成功';
}
// 释放锁
// 返回信息
return '更新失败';
