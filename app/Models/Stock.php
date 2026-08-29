<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['day','barcode','qty','user_id'];
}
