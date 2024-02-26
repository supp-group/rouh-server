<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'content',
'type',
'is_active',
             
    ];
    protected $appends= ['dept_conv'];
    public function getDeptConvAttribute()
    {
        $conv = "";
        switch($this->type) {
            case('form'):
                $conv = __('general.orders');
               break;
               case('answer'):
                $conv =__('general.answers');
               break;
               case('comment'):
                $conv = __('general.comments');
               break;
    
            default:
            $conv = $this->type;
        }
        return $conv;
    }
}
