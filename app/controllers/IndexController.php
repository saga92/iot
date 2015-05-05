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
        $this->view->status = 'register success';
    }

    public function loginAction(){
        if ($this->request->isPost() == true){
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            if ($username == "huang@bupt.cn"){
                $this->dispatcher->forward(
                    array(
                        "controller" => "index",
                        "action"     => "listnormal",
                    )
                );
            }else if ($username == "admin@bupt.cn"){
                $this->dispatcher->forward(
                    array(
                        "controller" => "index",
                        "action"     => "list",
                    )
                );
            }else{
                return;
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
        $this->view->username = 'Hi! admin@bupt.cn';
        $this->view->url = "#";
    }

    public function listnormalAction(){
        $this->view->username = 'Hi! huang@bupt.cn';
        $this->view->url = "#";
    }

    public function historynormalAction(){
        $this->view->username = 'Hi! huang@bupt.cn';
        $this->view->url = "#";
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
        $this->view->buyStatus = 'success';
    }

    public function buynormalAction(){
        $this->view->username = 'Hi! admin@bupt.cn';
        $this->view->url = "#";
    }
}
