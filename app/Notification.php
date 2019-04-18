<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 15/04/2019
 * Time: 11:10
 */

namespace Ddondola;


use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    private function data($item) {
        return collect($this->data)->get($item, '');
    }

    public function translatedData() {
        return 'todo notification data implementation';
    }
}