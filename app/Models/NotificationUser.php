<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'notification_id',
'client_id',
'expert_id',
'user_id',
'isread',
'read_at',
'state',
'notes',

         
    ];
}
