<?php

use Iot\Models\Resource as Resource;

class AdminController extends ControllerBase{

    public function indexAction(){

    }

    public function delresAction()
    {
        if ($this->request->isPost() == true)
        {
            $res_id = $this->request->getPost('res_id');
            $res = Resource::findFirst(
                array(
                    'id' => $res_id,
                )
            );
            if ($res != null){
                $res->is_del = 1;
                $res->save();
                $this->view->pick('/index/index');
                $this->view->delresStatus = 'del res success';
            }else{
                $this->view->pick('/index/index');
                $this->view->delresStatus = 'del res fail<br>';
            }
        }
    }
}
