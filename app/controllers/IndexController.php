<?php

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
            $phql1 = 'SELECT * FROM User WHERE username=:username:';
            $result = $this->modelsManager->executeQuery($phql1,
                array(
                    'username' => $username,
                )
            );
            if (count($result) == 0){
                $phql = 'INSERT INTO User(username, password, type, create_time, update_time, is_del)'
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
            $phql = 'SELECT * from User WHERE username=:username: AND password=:password:';
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
        
    }

}

