<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 14:10
 */

namespace App\Model;


class Users extends \PHPixie\ORM\Model {
    //Specify the PRIMARY KEY
    public $id_field='user_id';

    //Specify table name
    public $table='Users';

}