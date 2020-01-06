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
        return collect($this->data)->get($item, null);
    }

    private function actor() {
        return $this->affiliate($this->data('actor'));
    }

    private function subject() {
        return $this->affiliate($this->data('subject'));
    }

    private function affiliate(array $affiliate = null) {
        if ($affiliate) {
            $affiliate = collect($affiliate);
            $type = $affiliate->get('type');

            return array_merge(
                $type::find($affiliate->get('id'))->only(['id', 'name', 'code']),
                ['type' => $this->type($type)]
            );
        }

        return null;
    }

    public function translatedData() {
        return [
            'type' => $this->data('type'),
            'actor' => $this->actor(),
            'subject' => $this->subject()
        ];
    }

    public function type($affiliate) {
        $path = explode('\\', $affiliate);
        return array_pop($path);
    }
}