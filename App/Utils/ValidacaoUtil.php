<?php 

namespace App\Utils;

use DateTime;
use TypeError;

final class ValidacaoUtil
{

    public function validaNull(array $data) : bool
    {
        foreach ($data as $item) 
        {
            if($item === null || $item === "")
            {
                return false;
            };
        }

        return true;
    }

}

?>