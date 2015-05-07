<?php

use Iot\Models\Resource as Resource;
use Iot\Models\History as History;
use Iot\Models\User as User;

class AdminController extends ControllerBase{

    public function indexAction(){

    }

    public function addAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->pick('index/login');
        }
    }

    public function addafAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->pick('index/login');
            return;
        }
        if($this->request->isPost() == true){
            $host_name = $this->request->getPost('host_name');
            $detail = $this->request->getPost('detail');
            $price = $this->request->getPost('price');
            $phql = "INSERT INTO Iot\Models\Resource(host_name, detail, price, history_id, "
                ." create_time, update_time, is_del)"
                ." VALUES (:host_name:, :detail:, :price:, :history_id:, :create_time:, :update_time:, :is_del:)";
            $result = $this->modelsManager->executeQuery($phql,
                array(
                    'host_name' => $host_name,
                    'detail'    => $detail,
                    'price'     => $price,
                    'history_id'   => 0,
                    'create_time' => date('Y-m-d H:m'),
                    'update_time' => date('Y-m-d H:m'),
                    'is_del'    => 0,
                )
            );
            if ($result->success() == true){
                $this->view->pick('admin/addaf');
                $this->view->inputStatus = 'add success';
            }else{
                $this->view->pick('admin/addaf');
                $me = '';
                foreach ($result->getMessages() as $message){
                    $me .= ($message.'<br/>');
                }
                $this->view->inputStatus = 'add fail<br/>'.$me;
            }
        }
    }

    public function delresAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $all_res = resource::find(
                array(
                    "is_del = 0",
                )
            );
            $this->view->res = $all_res;
        }else{
            $this->view->pick('index/login');
        }
    }
    public function delresafAction()
    {
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $all_res = resource::find(
                array(
                    "is_del = 0",
                )
            );
            $this->view->res = $all_res;
        }else{
            $this->view->pick('index/login');
            return;
        }
        if ($this->request->isPost() == true)
        {
            $res_id = $this->request->getPost('resource_id');
            $res = Resource::findFirst(
                array(
                    "id=".$res_id." AND history_id=0",
                )
            );
            if ($res != null){
                $res->is_del = 1;
                $res->save();
                $this->view->delresStatus = 'del res success';
            }else{
                $this->view->delresStatus = 'del res fail, resource has been occupy';
            }
        }
    }

    public function reportAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $to_money = $this->totalMoney();
            $this->view->to_money = $to_money;
        }else{
            $this->view->pick('index/login');
        }
    }

    public function analyzeAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->pick('index/login');
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

    public function totalMoney(){
        $phql = "SELECT r.price AS res_price, h.month_num AS mu "
            ." FROM Iot\Models\History h LEFT OUTER JOIN Iot\Models\Resource r"
            ." ON h.resource_id = r.id";
        $result = $this->modelsManager->executeQuery($phql);
        $total_money = 0;
        foreach($result as $re){
            $total_money += ($re->res_price * $re->mu);
        }
        return $total_money;
    }
}
