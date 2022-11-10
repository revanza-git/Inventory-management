<?php

namespace App\Models;

use App\Models\Part;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlowInPart extends Model
{
    use HasFactory;
    protected $table = 'dbo.flow_in_part';
    protected $primaryKey = 'id_flowInPart';
    public $timestamps = false;

    public function PartRelationship()
    {
        return $this->belongsTo(Part::class, 'idPart', 'idPart');
    }

    public function historyIn()
    {
        return $this->hasMany(HistoryIn::class, 'id_flowInPart', 'id_flowInPart');
    }

    protected $guarded = ['id_flowInPart'];

}
