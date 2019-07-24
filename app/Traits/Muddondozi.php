<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-04-06
 * Time: 12:26 AM
 */

namespace Ddondola\Traits;


use Messenger\Traits\Converser;
use Bank\Traits\Transactor;

trait Muddondozi
{
    use Converser, Transactor;

    /**
     * Type of actor
     *
     * @return string
     */
    public function type() {
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }
}