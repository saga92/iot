<?php

namespace Iot\Models;

use Phalcon\Mvc\Model as Model;

class User extends Model{
    public function getSource(){
        return 'user';
    }
}
