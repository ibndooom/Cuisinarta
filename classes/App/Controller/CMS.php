<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 16:49
 */

namespace App\Controller;


class CMS extends \App\Page {
    public function action_index(){
        $auth=$this->pixie->auth;
        $logged = $auth->logged_with();

        if ($logged == 'password') {
            $this->view->template = 'page';
            $this->view->result = $this->pixie->orm->get('users')->where('login','123')->count_all();

        }
        else {
            $this->view->login = 'ibndoom';
            $this->view->password = '123';
            $this->view->template = 'layout/loginForm';
        }
    }
} 