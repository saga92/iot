<?php

use Iot\Models\Resource as Resource;
use Iot\Models\User as User;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->username='hello';
        $this->view->password='world';
    }

    public function showAction($postId){
        $this->view->title = 'title';
        $this->view->post = 'post';
        $this->view->show_navigation = true;
    }

    public function registerAction(){
        if ($this->request->isPost() == true){
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("passwd");
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
            $password = $this->request->getPost('passwd');
            $phql = 'SELECT * from Iot\Models\User WHERE username=:username: AND password=:password:';
            $result = $this->modelsManager->executeQuery($phql,
                array(
                    'username' => $username,
                    'password' => $password,
                )
            );
            if (count($result) == 0){
                $this->view->status = 'login fail';
            }else{
                $this->view->status = 'login success';
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
                    'user_id'   => 0,
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
        $res = Resource::find(
            array(
                "is_del = 0",
            )
        );
        $this->view->res = $res;
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
}
