<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Selectedservice extends Model
{
    use HasFactory;
    protected $fillable = [

        'client_id',
        'expert_id',
        'service_id',
        'points',
        'rate',
        'comment',
        'status',
        'comment_rate',
        'expert_cost',
        'cost_type',
        'expert_cost_value',
        'comment_date',
        'comment_state',
        'comment_reject_reason',
        'form_state',
        'comment_user_id',
        'company_profit',
        'company_profit_percent',
    ];     
    /* deleted
        // 'answer',
          //  'answer2',
       //  'iscommentconfirmd',
           // 'issendconfirmd',
            //'isanswerconfirmd',
    */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)->withDefault();
    }
    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class)->withDefault();
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    public function valueServices(): HasMany
    {
        return $this->hasMany(ValueService::class);
    }
    public function pointtransfers(): HasMany
    {
        return $this->hasMany(Pointtransfer::class);
    }

}
