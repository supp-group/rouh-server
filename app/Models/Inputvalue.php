<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inputvalue extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'input_id',
        'is_active',

    ];
    public function input(): BelongsTo
    {
        return $this->belongsTo(Input::class)->withDefault();
    }


}
