<?php

namespace nilsenj\Uber\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class UberSDK
 *
 * @package App\Core\components\ActiveItem\Facades
 */
class UberFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Uber';
    }

}
