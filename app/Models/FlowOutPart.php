<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowOutPart extends Model
{
    use HasFactory;
    protected $table = 'dbo.flow_out_part';
    protected $primaryKey = 'id_flowOutPart';
    public $timestamps = false;

    public function PartRelationship()
    {
        return $this->belongsTo(Part::class, 'idPart', 'idPart');
    }
    public function historyOut()
    {
        return $this->hasMany(FlowOutPart::class, 'id_flowOutPart', 'id_flowOutPart');
    }

    protected $guarded = ['id_flowOutPart',];

}
