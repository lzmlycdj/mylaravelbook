<?php
/**
 * 
 * 怎么用mysq workbench建模和使用laravel的model
 */
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //Member模型已经与member数据库表绑定了

    protected $table = 'member';
    protected $primaryKey = 'id';

}
