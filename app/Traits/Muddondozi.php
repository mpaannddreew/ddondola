<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-04-06
 * Time: 12:26 AM
 */

namespace Ddondola\Traits;


use Bank\Traits\Holder;
use Messenger\Traits\Converser;

trait Muddondozi
{
    use Converser, Holder;

    /**
     * Type of actor
     *
     * @return string
     */
    public function type() {
        $path = explode('\\', __CLASS__);
        return array_pop($path);
    }

    public function setUp() {
        $this->createAccount();
    }
}