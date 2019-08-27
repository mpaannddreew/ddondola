<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 11:14
 */

namespace Bank;


use Bank\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class EcryptableModel extends Model
{
    use Encryptable;
}