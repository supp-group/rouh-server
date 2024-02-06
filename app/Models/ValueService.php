<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ValueService extends Model
{
    use HasFactory;
    protected $table = 'values_services';
    protected $fillable = [
        'value',
        'selectedservice_id',
        'inputservice_id',
        'name',
        'type',
        'tooltipe',
        'icon',
        'ispersonal',
        'image_count',
    ];


    public function selectedservices(): BelongsTo
    {
        return $this->belongsTo(Selectedservice::class)->withDefault();
    }
    public function inputServices(): BelongsTo
    {
        return $this->belongsTo(InputService::class)->withDefault();
    }
}
