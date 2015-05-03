<?php

use Iot\Models\Resource as Resource;
use Iot\Models\History as History;

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
    public function checkTimeout($user_id){
        //检查是否资源到期
        $phql = 'SELECT * FROM Iot\Models\History WHERE user_id = :user_id: and'
            .'util_time < :util_time:';
        $historys = $this->modelsManager->executeQuery(
            $phql, array(
                'user_id' => $user_id,
                'util_time' => $util_time
            )
        );
        foreach($historys as $history){
            $res = Resource::find(
                array(
                    'id='.$history->resource_id,
                )
            );
            $res->is_occupy = 1;
            $res->save();
        }
    }

    public function totalMoney($user_id){
        $phql = "SELECT * FROM Iot\Models\History h LEFT OUTER JOIN Iot\Models\Resource r"
            ." ON h.resource_id = r.id";
        $result = $this->modelsManager->executeQuery($phql);
        $total_money = 0;
        foreach($result as $re){
            $total_money += ($re->price * $re->month_num);
        }
        return $total_money;
    }
}
