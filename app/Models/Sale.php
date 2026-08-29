<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['sale_no','barcode','qty','price','final','type'];
}
