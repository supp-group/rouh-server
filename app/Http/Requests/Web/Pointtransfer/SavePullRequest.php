<?php

namespace App\Http\Requests\Web\Pointtransfer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
class SavePullRequest extends FormRequest
{
   
   //protected $alphaexpr='/^[\pL\s\_\-\0-9]+$/u';
    

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   
     public function rules(): array
     {
        
       
        return[
         // 'field_name'=>'required|string|regex:'.$this->alphaexpr,  
         'field_type'=>'required|in:text,bool,list,date,longtext', 
         
         'field_tooltipe'=>'required|string|regex:'.$this->alphaexpr,  
         'count'=>'required|integer', 
         'price'=>'required|decimal:0,2', 
         'countbefor'=>'nullable|integer', 
           
        //   Rule::notIn(['sprinkles', 'cherries']),//not_in:shipsTo



           ];   
     
     }
     /**
  * Get the error messages for the defined validation rules. 'decimal:2'
 
  *
  * @return array<string, string>
  */
 public function messages(): array
 {
   
    return[   
       'field_name.required'=> __('messages.this field is required') ,       
       'field_type.required'=> __('messages.this field is required') ,  
      'field_type.in' => __('messages.this field is required') , 
      'count.required'=> __('messages.this field is required') ,
      'count.integer'=> __('messages.must be integer') ,
      'countbefor.integer'=> __('messages.must be integer') ,
      'price.required'=>__('messages.this field is required') ,  
      'price.decimal'=>__('messages.must be integer') ,  
     ];
     
 }
 
}
