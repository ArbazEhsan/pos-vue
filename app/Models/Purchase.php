<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['pur_no','barcode','qty','price','final','type'];
}
