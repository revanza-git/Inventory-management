<?php

namespace App\Models;

use App\Models\FlowInPart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryIn extends Model
{
    use HasFactory;
    protected $table = 'dbo.history_in';
    protected $primaryKey = 'id_historyIn';
    public $timestamps = false;

    public function historyIn()
    {
        return $this->belongsTo(FlowInPart::class, 'id_flowInPart', 'id_flowInPart');
    }

    protected $guarded = ['id_historyIn'];
}
