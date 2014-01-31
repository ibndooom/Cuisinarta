<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 14:10
 */

namespace App\Model;


class SubscribersLists extends \PHPixie\ORM\Model {
    //Specify the PRIMARY KEY
    public $id_field='id';

    //Specify table name
    public $table='subscriberslists';

    protected $has_many=array(
        'lists'=>array(
            'model'=>'lists',
            'key'=>'list_id'
        ),
        'subscribers'=>array(
            'model'=>'subscribers',
            'key'=>'subs_id'
        ),
    );

}