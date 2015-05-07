<?php

use Iot\Models\Resource as Resource;
use Iot\Models\User as User;
use Iot\Models\History as History;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    }

    public function showAction(){
        //register fake
    }

    public function changepwdnormalAction(){

    }

    public function registerAction(){
        if ($this->request->isPost() == true){
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            $type = $this->request->getPost("type");
            $phql1 = 'SELECT * FROM Iot\Models\User WHERE username=:username:';
            $result = $this->modelsManager->executeQuery($phql1,
                array(
                    'username' => $username,
                )
            );
            if (count($result) == 0){
                $phql = 'INSERT INTO Iot\Models\User(username, password, type, create_time, update_time, is_del)'
                    .'VALUES (:username:, :password:, :type:, :create_time:, :update_time:, :is_del:)';
                $result = $this->modelsManager->executeQuery($phql,
                    array(
                        'username' => $username,
                        'password' => $password,
                        'type' => $type,
                        'create_time' => date('Y-m-d H:m'),
                        'update_time' => date('Y-m-d H:m'),
                        'is_del' => 0,
                    )
                );
                $me = '';
                if ($result->success() == false){
                    foreach ($result->getMessages() as $message){
                        $me .= ($message."<br>");
                    }
                    $this->view->status = $me;
                }else{
                    $this->view->status = 'register success';
                }
            }else{
                $this->view->status = 'user already exist';
            }
        }
    }

    public function loginAction(){
        if ($this->request->isPost() == true){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $phql = 'SELECT * from Iot\Models\User WHERE username=:username: AND password=:password:';
            $result = $this->modelsManager->executeQuery($phql,
                array(
                    'username' => $username,
                    'password' => $password,
                )
            );
            if (count($result) == 0){
                return;
            }else{
                $this->session->set('user-id', $result[0]->id);
                if ($result[0]->type == 0){
                    $ac = "listnormal";
                }else{
                    $ac = "list";
                }
                $this->dispatcher->forward(
                    array(
                        "controller" => "index",
                        "action"     => $ac,
                    )
                );
                //$this->view->pick('index/list');
                //$this->view->username = $result[0]->username;
            }
        }
    }

    public function listAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $res = Resource::find(
                array(
                    "is_del = 0",
                )
            );
            $this->view->res = $res;
        }else{
            $this->view->url = "index/login";
        }
    }

    public function listnormalAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $phql = "SELECT r.id AS rid, r.host_name AS hname, r.detail AS rdetail, r.price AS price,"
                ." h.month_num AS mu, h.util_time AS utime "
                ." FROM Iot\Models\Resource r LEFT OUTER JOIN Iot\Models\History h "
                ." ON r.history_id=h.id "
                ." WHERE r.is_del=0 AND h.user_id=:user_id:";
            $res = $this->modelsManager->executeQuery($phql,
                array(
                    "user_id" => $user_id,
                )
            );
            $this->view->res = $res;
        }else{
            $this->view->pick('index/login');
        }
    }

    public function historynormalAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $phql = "SELECT h.resource_id AS rid, h.month_num AS mu, h.util_time AS utime, "
                ." r.host_name AS hname, r.detail AS rdetail, r.price AS price "
                ." FROM Iot\Models\History AS h LEFT OUTER JOIN Iot\Models\Resource AS r "
                ." ON r.id=h.resource_id WHERE r.is_del=0 AND h.is_del=0 AND h.user_id=:user_id:";
            $res = $this->modelsManager->executeQuery($phql,
                array(
                    "user_id" => $user_id,
                )
            );
            $this->view->res = $res;
        }else{
            $this->view->pick('index/login');
        }
    }

    public function changePwdAction(){
        $user_id = $this->session->get('user-id');

        if ($this->request->isPost() != true){
            $this->view->changePwdStatus = 'fail, request is not post';
            return;
        }else{
            $new_pwd = $this->request->getPost('password');
        }
        $this->logger->log("val of new_pwd=$new_pwd");

        if ($this->session->has('user-id')){
            $user = User::findFirst(
                array(
                    "id = ".$user_id
                )
            );
            if ($user != null){
                $user->password = $new_pwd;
                $user->save();
                $this->view->changePwdStatus = 'success';
            }else{
                $this->view->changePwdStatus = 'user not found in database';
            }
        }else{
            $this->view->pick('index/login');
        }
    }
    public function buyAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = user::findfirst($user_id);
            $this->view->username = 'hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->username = "login";
            $this->view->url = "index/login";
            return;
        }
        $idle_res = resource::find(
            array(
                "is_del = 0 AND history_id = 0",
            )
        );
        $this->view->res = $idle_res;

        if ($this->request->isPost() == true){
            $res_id = $this->request->getPost('resource_id');
            $month_num = $this->request->getPost('month_num');
        }else{
            $this->view->pick('index/buy');
            $this->view->buyStatus = 'fail request method wrong';
            return;
        }
        if ($this->session->has('user-id')){
            $his = new History();
            $res = Resource::findFirst($res_id);
            if ($res->history_id != 0){
                $this->view->pick('index/buy');
                $this->view->buyStatus = 'fail, the resource bought by others';
                return;
            }
            $his->resource_id = $res->id;
            $his->user_id = $user_id;
            $his->month_num = $month_num;
            $util_time = new DateTime('NOW', new DateTimeZone("UTC"));
            $util_time->add(new DateInterval("P".$month_num."M"));
            $his->util_time = $util_time->format('Y-m-d H:m');
            $his->create_time = date('Y-m-d H:m');
            $his->update_time = date('Y-m-d H:m');
            $his->is_del = 0;
            if ($his->save() == true){
                $this->view->buyStatus = "selected sucess ";
                $res->history_id = $his->id;
                if ($res->save() == true){
                    $this->view->buyStatus .= "buy complete";
                }
            }else{
                $me = "";
                foreach( $his->getMessages() as $message){
                    $me .= $message;
                }
                $this->view->buyStatus = "db error".$me;
            }
        }else{
            $this->view->pick('index/buy');
            $this->view->buyStatus = 'fail, you should login';
        }
    }

    public function buynormalAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = user::findfirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->pick('index/login');
            return;
        }
        $res = resource::find(
            array(
                "history_id = 2 AND is_del=1",
            )
        );
        $this->view->res = $res;
    }

    public function logoutAction(){
        $this->session->destroy();
    }

    public function helpAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->pick('index/login');
        }
    }
}
