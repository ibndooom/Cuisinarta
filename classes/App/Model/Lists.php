<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 14:10
 */

namespace App\Model;


class Lists extends \PHPixie\ORM\Model {
    //Specify the PRIMARY KEY
    public $id_field='list_id';

    //Specify table name
    public $table='Lists';

    protected $belongs_to=array('subscriberslists');

}