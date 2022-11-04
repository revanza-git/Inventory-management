<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecretCode extends Model
{
    use HasFactory;
    protected $table = 'dbo.secret_code';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
}
