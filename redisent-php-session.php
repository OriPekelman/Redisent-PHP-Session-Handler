<?php
require_once 'redisent.php';

$redisServer = null; //Redis Instance
$redisTargetPrefix = ""; // Key prefix for sessions

function redis_session_init($server = 'localhost', $port = 6379, $prefix = "session:php:" ) 
{
 global $redisServer, $redisTargetPrefix;

 if ($server !== null) {
   $redisServer = new Redisent($server,$port);
 }

 if ($prefix !== null) {
   $redisTargetPrefix = $prefix;
 }

 session_set_save_handler('redis_session_open',
                           'redis_session_close',
                           'redis_session_read',
                           'redis_session_write',
                           'redis_session_destroy',
                           'redis_session_gc');

 register_shutdown_function('session_write_close');
}



function redis_session_read($id) {
   global $redisServer, $redisTargetPrefix;
   return $redisServer->get($redisTargetPrefix . $id);
}


function redis_session_write($id, $data) {
   global $redisServer, $redisTargetPrefix;
   $ttl = ini_get("session.gc_maxlifetime");
   $redisServer->setex($redisTargetPrefix . $id,$ttl,$data);
}


function redis_session_destroy($id) {
   global $redisServer, $redisTargetPrefix;
   $redisServer->del($redisTargetPrefix . $id);
}

function redis_session_open($path, $name) {}
function redis_session_close() {}
function redis_session_gc($age) {}