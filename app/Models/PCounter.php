<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCounter extends Model
{
    use HasFactory;
    protected $table = 'pcounters';
    public $primaryKey = 'id';
    public $timestamps = true;
}
