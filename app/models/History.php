<?php

namespace Iot\Models;
use Phalcon\Mvc\Model as Model;

class History extends Model{

    public function getSource(){
        return 'history';
    }
}

