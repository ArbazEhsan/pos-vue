<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleTax extends Model
{
    use HasFactory;
    protected $table = 'salesTaxs';
    public $primaryKey = 'id';
    public $timestamps = true;
}
