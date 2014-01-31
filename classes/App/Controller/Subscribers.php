<?php
/**
 * Created by PhpStorm.
 * User: ibndoom
 * Date: 18.01.14
 * Time: 13:07
 */

namespace App\Controller;


class Subscribers extends \App\Page {
    public function action_index(){

    }

    public function action_add(){
        if($this->request->method == 'POST'){
            $validate = $this->pixie->validate->get($this->request->post());
            $validate->field('listName')->rules('filled', 'alpha');

            $listName = $this->request->post('name');

            if ($validate->valid())
            {
                $listExist = $this->pixie->orm->get('lists')->where('name',$listName)->count_all();

                if ($listExist > 0) {
                    $this->view->error = 'List with this name exist';
                    $this->view->name = $listName;
                    $this->view->template = 'layout/addListForm';
                } else {
                    $newList = array(
                        'name'=>$this->request->post('listName')
                    );
                    $this->pixie->orm->get('lists')->values($newList)->save();
                    $this->view->message = 'New list added!';
                    $this->view->template = 'layout/addListForm';
                }
            }
            else
            {
                $this->view->error = 'Incorrect list name';
                $this->view->name = $listName;
                $this->view->template = 'layout/addListForm';
            }

        } else {
            $auth=$this->pixie->auth;
            if ($auth->logged_with() == 'password') {
                $this->view->template = 'layout/addListForm';
            } else {
                $this->redirect('layout/loginForm');
            }
        }
    }

    public function action_edit(){

    }

    public function action_delete(){

    }

    public function action_save(){

    }
} 