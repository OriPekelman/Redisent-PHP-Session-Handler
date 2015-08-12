# [NOT MAINTAINED]

# Redisent PHP Session Handler
Copyright AF83 (2011) Contributions by PC

This is a session handler for PHP using the Redisent Library for the amazing Redis Key Value Store (http://redis.io). 

# You are better off using https://github.com/nicolasff/phpredis so if you can use the compiled extension do that!

To use, first get https://github.com/damz/redisent (or the upstream version, but this one should still be better)
And simply include it and call in your initialization script:
redis_session_init($server = 'localhost', $port = 6379, $prefix = "session:php:" ) ;

Note: for horrible PHP reasons we have to manually call session_write_close so you are going to be writing to the session on every script execution. Whether the session data change or not

