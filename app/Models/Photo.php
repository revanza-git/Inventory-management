<?php

namespace App\Models;

use App\Models\Part;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'dbo.photo';
    protected $primaryKey = 'idPhoto';
    public $timestamps = false;

    public function PartRelationship()
    {
        return $this->belongsTo(Part::class, 'idPart', 'idPart');
    }
    
    protected $guarded = ['idPhoto'];
}
