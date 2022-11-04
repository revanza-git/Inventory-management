<?php

namespace App\Models;

use App\Models\FlowOutPart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryOut extends Model
{
    use HasFactory;
    protected $table = 'dbo.history_out';
    protected $primaryKey = 'id_historyOut';
    public $timestamps = false;

    public function historyOut()
    {
        return $this->belongsTo(FlowOutPart::class, 'id_flowOutPart', 'id_flowOutPart');
    }

    protected $guarded = ['id_historyOut'];

}
