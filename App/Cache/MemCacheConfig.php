<?php 

namespace App\Cache;

abstract class MemCacheConfig
{
    protected $memcache;

    public function __construct()
    {
        $host = getenv('MEMCACHED_HOST');
        $port = getenv('MEMCACHED_PORT');

        $this->memcache = new \Memcache;
        $this->memcache->connect($host, $port) or die ("Could not connect");
    }
}

?>