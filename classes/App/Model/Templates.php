<?php
/**
 * Created by PhpStorm.
 * User: Art
 * Date: 17.01.14
 * Time: 14:10
 */

namespace App\Model;


class Templates extends \PHPixie\ORM\Model {
    //Specify the PRIMARY KEY
    public $id_field='template_id';

    //Specify table name
    public $table='Templates';

}