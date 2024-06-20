<?php 

namespace App\Cache;

use App\Cache\MemCacheConfig;

class CartaCache extends MemCacheConfig
{
    public function __construct()
    {

        parent::__construct();

    }

    public function salvarCartasCache(array $cartas) : void
    {

        $this->memcache->set('cartas', $cartas, false, 3600) or die ("Failed to save data at the server");
 
    }

    public function recuperarCartasCache() : ?array
    {
        if($this->memcache->get('cartas') === false){
            return null;
        }

        return $this->memcache->get('cartas');
    }
}

?>