<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_id',
        'allowcomment',
        'allowanswer',
        'allowsend',
          
        
             
    ];
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)->withDefault();
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
