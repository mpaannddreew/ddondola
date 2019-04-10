<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-04-06
 * Time: 12:26 AM
 */

namespace Ddondola\Traits;


use Activity\Traits\Actor;

trait Muddondozi
{
    use Actor;

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