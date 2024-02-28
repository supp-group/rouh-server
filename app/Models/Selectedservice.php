<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB; 
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
        'form_reject_reason',
    ];  
 protected $appends= ['form_state_conv','answer_state','answer_state_conv','comment_state_conv'];
 public function getFormStateConvAttribute(){
    $conv="";
    switch($this->form_state) {
        case('wait'):
            $conv = __('general.wait');
           break;
           case('agree'):
            $conv =__('general.status.agree');
           break;
           case('reject'):
            $conv = __('general.status.reject');
           break;

        default:
        $conv = $this->form_state;
    }
        return  $conv;
 }

 public function getAnswerStateAttribute(){
    $conv="";
 
    if($this->answers->isEmpty()){
        $conv='no_answer';
    }else
    {
      //  $answer=  DB::table('answers')->where('selectedservice_id',$this->id)->latest() ;
       $answer= $this->answers->sortBy('created_at')->last()->answer_state ;
         if( $answer =='reject'){
        $conv='reject';
    }else if ($answer =='agree'){
        $conv='agree';
    }else if($answer=='wait'){
        $conv='wait';
    }
}
     
        return  $conv;
 }

 public function getAnswerStateConvAttribute(){
    $conv="";
 
    if($this->answer_state=='no_answer' ){
        $conv=__('general.status.no_answer');
    }       
    else if( $this->answer_state=='reject'){
        $conv=__('general.status.reject');
    }else if ($this->answer_state=='agree'){
        $conv=__('general.status.agree');
    }else if($this->answer_state=='wait'){
        $conv=__('general.wait');;
    }
 
     
        return  $conv;
 }
 public function getCommentStateConvAttribute(){
    $conv="";
    switch($this->comment_state) {
        case('wait'):
            $conv = __('general.wait');
           break;
           case('agree'):
            $conv =__('general.comment')." ".__('general.status.agree');
           break;
           case('reject'):
            $conv = __('general.comment')." ".__('general.status.reject');
           break;

        default:
        $conv = $this->comment_state;
    }
        return  $conv;
 }


 

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
    public function answers(): HasMany
    {
         
        return $this->hasMany(Answer::class);
    }
    public function cashTransfers(): HasMany
    {
        return $this->hasMany(Cashtransfer::class,'selectedservice_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'comment_user_id')->withDefault();
    }
}
