<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'record',
        'content',
        'answer_reject_reason',
        'answer_state',
        'selectedservice_id',
        'updateuser_id',
           
    ];
    public function selectedservices(): BelongsTo
    {
        return $this->belongsTo(Selectedservice::class)->withDefault();
    }
}
