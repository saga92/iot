<?php

namespace Iot\Models;

use Phalcon\Mvc\Model as Model;

class Resource extends Model{

    public function getSource(){
        return 'resource';
    }

}
