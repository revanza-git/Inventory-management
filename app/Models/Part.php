<?php

namespace App\Models;

use App\Models\FlowInPart;
use App\Models\FlowOutPart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Part extends Model
{
    use HasFactory;

    protected $table = 'dbo.part';
    protected $primaryKey = 'idPart';
    public $timestamps = false;

    public function flowInPart()
    {
        return $this->hasMany(FlowInPart::class, 'idPart', 'idPart');
    }
    public function flowOutPart()
    {
        return $this->hasMany(FlowOutPart::class, 'idPart', 'idPart');
    }
    public function getStock($date)
    {
        $sumFlowIn = $this->flowInPart()->whereDate('dtStockPartApprovedIn', '<=', $date)->sum('qtyStockPartIn');

        $sumFlowOut = $this->flowOutPart()->whereDate('dtStockPartApprovedOut', '<=', $date)->sum('qtyStockPartOut');

        return $sumFlowIn - $sumFlowOut;
    }
    protected $guarded = ['idPart'];
}
