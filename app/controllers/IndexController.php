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

    public function inputAction(){
        if($this->request->isPost() == true){
            $host_name = $this->request->getPost('host_name');
            $detail = $this->request->getPost('detail');
            $price = $this->request->getPost('price');
            $phql = "INSERT INTO Iot\Models\Resource(host_name, detail, price, user_id, create_time, update_time, is_del)"
                ."VALUES (:host_name:, :detail:, :price:, :user_id:, :create_time:, :update_time:, :is_del:)";
            $result = $this->modelsManager->executeQuery($phql,
                array(
                    'host_name' => $host_name,
                    'detail'    => $detail,
                    'price'     => $price,
                    'is_occupy'   => 0,
                    'create_time' => date('Y-m-d H:m'),
                    'update_time' => date('Y-m-d H:m'),
                    'is_del'    => 0,
                )
            );
            if ($result->success() == true){
                $this->view->pick('index/index');
                $this->view->inputStatus = 'add success';
            }else{
                $this->view->pick('index/index');
                $me = '';
                foreach ($result->getMessages() as $message){
                    $me .= ($message.'<br/>');
                }
                $this->view->inputStatus = 'add fail<br/>'.$me;
            }
        }
    }

    public function listAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->username = "login";
            $this->view->url = "index/login";
        }
        $res = Resource::find(
            array(
                "is_del = 0",
            )
        );
        $this->view->res = $res;
    }

    public function listnormalAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $phql = "SELECT * FROM Iot\Models\Resource r LEFT OUTER JOIN Iot\Models\History h "
                ." ON r.history_id=h.id "
                ." WHERE r.is_del=0 AND h.user_id=:user_id:";
            $res = $this->modelsManager->executeQuery($phql,
                array(
                    "user_id" => $user_id,
                )
            );
            $this->view->res = $res;
        }else{
            $this->view->username = "login";
            $this->view->url = "index/login";
        }
    }

    public function historynormalAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
            $phql = "SELECT * FROM Iot\Models\History AS h LEFT OUTER JOIN Iot\Models\Resource AS r"
                ." ON r.id=h.resource_id WHERE r.is_del=0 AND h.is_del=0 AND h.user_id=:user_id:";
            $res = $this->modelsManager->executeQuery($phql,
                array(
                    "user_id" => $user_id,
                )
            );
            $this->view->res = $res;
        }else{
            $this->view->username = "login";
            $this->view->url = "index/login";
        }
    }

    public function changePwdAction(){
        $this->view->pick('index/index');
        $this->session->set('user-id', '1');

        if ($this->request->isPost() != true){
            $this->view->changePwdStatus = 'fail, request is not post';
            return;
        }

        if ($this->session->has('user-id')){
            $userid = $this->session->get('user-id');
            $user = User::findFirst(
                array(
                    "id = ".$userid
                )
            );
            $this->view->pick('index/index');
            if ($user != null){
                $user->password = $this->request->getPost("npwd");
                $user->save();
                $this->view->changePwdStatus = 'success';
            }else{
                $this->view->changePwdStatus = 'user not found in database';
            }
        }else{
            $this->view->pick('index/index');
            $this->view->changePwdStatus = 'fail, you should login';
        }
    }
    public function buyAction(){
        if ($this->request->isPost() == true){
            $res_id = $this->request->getPost('resource_id');
            $month_num = $this->request->getPost('month_num');
        }else{
            $this->view->pick('index/buy');
            $this->view->buyStatus = 'fail request method wrong';
            return;
        }
        if ($this->session->has('user-id')){
            $userid = $this->session->get('user-id');
            $month_num = $this->session->get('month_num');
            $util_time = $this->session->get('util_time');
            $res = Resource::find($res_id);
            if ($res->history_id != 0){
                $this->view->pick('index/index');
                $this->view->buyStatus = 'fail, the resource has user';
            }else{
                $res->user_id = $userid;
                $res->month_num = $month_num;
                $res->util_time = $util_time;
                $res->save();
                $this->view->pick('index/index');
                $this->view->buyStatus = 'success';
            }
        }else{
            $this->view->pick('index/buy');
            $this->view->buyStatus = 'fail, you should login';
        }
    }

    public function buynormalAction(){
        if ($this->session->has('user-id')){
            $user_id = $this->session->get('user-id');
            $u = User::findFirst($user_id);
            $this->view->username = 'Hi! '.$u->username;
            $this->view->url = "#";
        }else{
            $this->view->username = "login";
            $this->view->url = "index/login";
        }
        $res = Resource::find(
            array(
                "is_del = 0",
            )
        );
        $this->view->res = $res;
    }
}
