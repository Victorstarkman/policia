<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Upper component
 */
class UpperComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public function upper($string){
        $stringArray= explode(" ", $string);
        $numero = count($stringArray);
        if ($numero>1)
        {
            //echo var_dump($stringArray);
            $stringcompleto='';
            $count=1;
            foreach($stringArray as $palabra){
                $stringcompleto.=ucfirst( mb_convert_case($palabra, MB_CASE_LOWER, "UTF-8"));
                $stringcompleto.=" ";
            } 
            return trim($stringcompleto);
        }else{
        return  ucfirst( mb_convert_case($string, MB_CASE_LOWER, "UTF-8"));  
        }
    }
}
