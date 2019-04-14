<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-04-06
 * Time: 12:26 AM
 */

namespace Ddondola\Traits;


use Activity\Traits\Actor;
use Messenger\Traits\Converser;

trait Muddondozi
{
    use Actor, Converser;

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