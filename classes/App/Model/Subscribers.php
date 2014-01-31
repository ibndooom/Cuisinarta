<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 14:10
 */

namespace App\Model;


class Subscribers extends \PHPixie\ORM\Model {
    //Specify the PRIMARY KEY
    public $id_field='subs_id';

    //Specify table name
    public $table='Subscribers';

    protected $belongs_to=array('SubscribersLists');

}