<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Pointtransfer extends Model
{
    use HasFactory;
    
    protected $table = 'pointstransfers';
    protected $fillable = [
        'point_id',
'client_id',
'expert_id',
'service_id',
'count',
'status',
'selectedservice_id',
'side',
'state',
'type',
'source_id',
'num',
    ];
    protected  $hidden= ['desc' ];
    public function getDescAttribute(){
        $conv="";
    //client
        if($this->point_id>0 && $this->client_id>0 ){
            $pur='شراء';
            $valu='بقيمة';
            $point='نقطة';
            if(!is_null($this->cashTransfers->first())){
                $conv= $pur.' '.$this->count.' '.$point.' '.$valu.' '.$this->cashTransfers->first()->cash ;
           
            }
      
        
           
        }       
        else if($this->client_id>0 && $this->selectedservice_id>0 && $this->side=="from-client" ) {
$type="سحب مقابل";
            $ask='طلب خدمة رقم';
            $link='<a href="'.route("order.edit",$this->selectedservice_id).'" >'.$this->selectedservices->order_num.' </a>' ;
         //   $conv= $type.' '.$ask.' '.$this->selectedservices->order_num  ;
            $conv= $type.' '.$ask.' '. $link ;
        } 
        else if($this->client_id>0 && $this->selectedservice_id>0 && $this->side=="to-client" && $this->state=="reject-return" ) {
            $type="ارجاع النقاط";
                        $reason='بسبب رفض الطلب رقم';
                        $link='<a href="'.route("order.edit",$this->selectedservice_id).'" >'.$this->selectedservices->order_num.' </a>' ;
                        $conv= $type.' '. $reason.' '.$link ; 
                      //  $conv= $type.' '. $reason.' '.$this->selectedservices->order_num ;                    
                    } 
                    
                    //end client
            return  $conv;
     }


    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class)->withDefault();
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withDefault();
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)->withDefault();
    }
    public function selectedservices(): BelongsTo
    {
        return $this->belongsTo(Selectedservice::class,'selectedservice_id')->withDefault();
    }
    public function point(): BelongsTo
    {
        return $this->belongsTo(Point::class)->withDefault();
    }
    public function cashTransfers(): HasMany
    {
        return $this->hasMany(Cashtransfer::class,'pointtransfer_id');
    }

}
