<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1', 6379);
  $redis->set('hhq', 'hello world');
  echo $redis->get('test');
  echo $redis->get('hhq');