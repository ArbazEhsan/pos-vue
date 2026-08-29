<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id','page1','page2','page3','page4','page5','page6','page7','page8','page9','page10','page11','page12','page13','page14','page15','page16','page17','page18','page19','page20','page21','page22','page23','page24'];
}
