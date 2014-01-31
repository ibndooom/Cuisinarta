<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 16:03
 */

namespace App\Controller;


class User extends \App\Page {
    public function action_index(){
        $users = $this->pixie->orm->get('users')->find();
        $this->view->login = $users->login;
        $this->view->password = '123';

        $auth=$this->pixie->auth;
        $this->view->auth = $auth->logged_with();
    }

    public function action_login() {
        if($this->request->method == 'POST'){
            $login = $this->request->post('login');
            $password = $this->request->post('password');

            $logged = $this->pixie->auth
                ->provider('password')
                ->login($login, $password);

            if ($logged) {
                $this->view->auth = 'ok';
                $this->redirect('/');
            }
            else {
                $this->view->auth = $this->pixie->auth;
                $this->view->error = 'Please check login and password';
                $this->redirect('/');
            }
        }
        $users = $this->pixie->orm->get('users')->find();
        if ($users) {
            $this->view->login = $users;
            $this->view->password = '123';
        } else {
            $this->view->login = 'admin';
            $this->view->password = '123';
        }
    }

    public function action_logout() {
        $this->pixie->auth->logout();
        $this->redirect('/');
    }

    public function action_add() {
        if($this->request->method == 'POST'){
            $validate = $this->pixie->validate->get($this->request->post());
            $validate->field('login')->rules('filled', 'alpha');
            $validate->field('password')->rule('filled');

            if ($validate->valid())
            {
                //TODO: Add user exist checking;
                $password = $this->request->post('password');
                $hash = $this->pixie->auth->provider('password')->hash_password($password);
                $newUser = array(
                    'login'=>$this->request->post('login'),
                    'password'=>$hash
                );
                $this->pixie->orm->get('users')->values($newUser)->save();

                $this->action_login();
            }
            else
            {
                $this->view->error = $validate->errors();
                $this->view->template = 'layout/registerForm';
            }

        } else {
            $this->view->error = '';
            $this->view->template = 'layout/registerForm';
        }
    }

    public function action_edit() {
        if($this->request->method == 'POST'){
            $validate = $this->pixie->validate->get($this->request->post());
            $validate->field('login')->rules('filled', 'alpha');
            $validate->field('password')->rule('filled');

            if ($validate->valid())
            {
                //TODO: Add user exist checking;
                $password = $this->request->post('password');
                $hash = $this->pixie->auth->provider('password')->hash_password($password);
                $newUser = array(
                    'login'=>$this->request->post('login'),
                    'password'=>$hash
                );
                $this->pixie->orm->get('users')->values($newUser)->save();

                $this->action_login();
            }
            else
            {
                $this->view->error = $validate->errors();
                $this->view->template = 'layout/registerForm';
            }

        } else {
            $auth=$this->pixie->auth;
            if ($auth->logged_with() == 'password') {
                $this->view->error = '';
                $this->view->template = 'layout/editForm';
            } else {
                $this->redirect('/');
            }
        }
    }
} 