<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoFTB extends Model
{
    use HasFactory;
    protected $table = 'dbo.auto_ftb';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];

}
