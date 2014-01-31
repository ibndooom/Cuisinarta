<?php
/**
 * Created by PhpStorm.
 * User: ibndoom
 * Date: 18.01.14
 * Time: 17:18
 */

namespace App\Controller;


class Templates extends \App\Page {
    public function action_index() {
        $this->view->template = 'layout/template/template';
        $this->view->lists = array();
    }

    public function action_add() {
        $this->view->template = 'layout/template/template';
        $userTemplates = $this->pixie->orm->get('templates')->find_all();
        $templatesList = array();
        foreach ($userTemplates as $template) {
            $templatesList = array(
                'name' => $template->name,
                'delete' => "/template/delete/$template->template_id"
            );
        }
        if($this->request->method == 'POST'){
            $html = $this->request->post('html-template');
            $this->pixie->orm->get('templates')->values(array(
                'name'=>time(),
                'html'=>$html
            ))->save();
        }

        $this->view->lists = $templatesList;
    }

    public function action_edit() {

    }
} 