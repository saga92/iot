<?php

class PostsController extends \Phalcon\Mvc\Controller{

    public function indexAction(){

    }

    public function showAction($postId){
        $this->view->title = 'title';
        $this->view->post = 'post';
        $this->view->show_navigation = true;
    }
}
