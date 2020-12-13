<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 11.12.2020
 * Time: 16:50
 */

namespace App;


use App\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}