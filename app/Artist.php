<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 12:22 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    protected $primaryKey = 'id';
}