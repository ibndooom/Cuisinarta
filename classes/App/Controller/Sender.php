<?php
/**
 * Created by PhpStorm.
 * User: ibndoom
 * Date: 18.01.14
 * Time: 14:11
 */

namespace App\Controller;


class Sender extends \App\Page {

    public function action_index(){
        $this->view->template = 'layout/send/send';
    }

    public function action_send(){
        if($this->request->method == 'POST'){
            $listID = $this->request->post('listid');
            $templateID = $this->request->post('templateid');
            $title = $this->request->post('sendtitle');

            $template = $this->pixie->orm->get('template')->where('template_id', $templateID)->find();
            $mailBody = $template->html;

            $subscribers = $this->pixie->orm->get('subscriberslists')->where('list_id', $listID)->find();
            foreach ($subscribers as $subscriber) {
                $sendList[] = $subscriber->email;
            }

            $this->pixie->email->send('ibndoom@yandex.ru', $sendList, $title,$mailBody);
        } else {
            $this->view->template = 'layout/send/send';
        }
    }
}