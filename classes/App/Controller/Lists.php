<?php
/**
 * Created by PhpStorm.
 * User: ibndoom
 * Date: 18.01.14
 * Time: 13:07
 */

namespace App\Controller;


class Lists extends \App\Page {
    public function action_index(){
        $this->view->template = 'layout/list/lists';
        $listsCount = $this->pixie->orm->get('lists')->count_all();
        if ($listsCount) {
            $listsNames = $this->pixie->orm->get('lists')->find_all();

            foreach ($listsNames as $name) {
                $listProp = $name->as_array();
                $listProp['count'] = 0;
                $listProp['edit'] = "/lists/edit/$name->list_id";
                $listProp['delete'] = "/lists/delete/$name->list_id";
                $lists[] = $listProp;
            }
            $this->view->lists = $lists;
        } else {
            $this->view->lists = array();
        }
        $this->view->template = 'layout/list/lists';
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
                $this->view->template = 'layout/list/addForm';
            } else {
                $this->redirect('/');
            }
        }
    }

    public function action_edit(){
        $listID = $this->request->post('id');
        $lists = $this->pixie->orm->get('subscriberslists')->where('list_id', $listID)->find();
        $usersInList = $lists->subscribers->find()->as_array();
        $allUsers = $lists->pixie->orm->get('subscribers')->find_all();
        foreach ($allUsers as $user) {
            $usersData = $user->as_array();
            $allUsersData[] = array(
                'value' => $usersData['subs_id'],
                'email' => $usersData['email'],
                'name' => $usersData['name'],
                'selected' => in_array($usersData['subs_id'], $usersInList)?'true':'false',
            );
        }
        $this->view->allUsers = $allUsersData;
        $this->view->template = 'layout/list/editForm';
    }

    public function action_delete(){

        $this->view->template = 'layout/lists';
    }

    public function action_save(){

        $this->view->template = 'layout/lists';
    }
} 