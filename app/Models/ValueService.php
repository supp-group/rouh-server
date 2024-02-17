<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\Api\StorageController;
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

    protected $appends= ['full_path_conv'];
    public function getFullPathConvAttribute(){
       $conv="";
       $strgCtrlr = new StorageController();
      
       switch($this->type) {
           case('image'):
            $url = $strgCtrlr->ValuePath('image');
               $conv =  $url.$this->value;
              break;
              case('record'):
                $url = $strgCtrlr->ValuePath('record');
                $conv =  $url.$this->value;
              break;  
           default:
           $conv = '';
       }
           return  $conv;
    }
   
    
    public function selectedservices(): BelongsTo
    {
        return $this->belongsTo(Selectedservice::class)->withDefault();
    }
    public function inputServices(): BelongsTo
    {
        return $this->belongsTo(InputService::class)->withDefault();
    }

}
