<?php
ignore_user_abort();
set_time_limit(0);
$interval = 3;
do {
  $fp = fopen('test.txt', 'a');
  fwrite($fp, time() . PHP_EOL);
  fclose($fp);
  sleep($interval);
} while (true);

// 1611822749
// 1611822752
// 1611822755
// 1611822759
// 1611822762
