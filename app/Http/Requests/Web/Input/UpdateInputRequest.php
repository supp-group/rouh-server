<?php

namespace App\Http\Requests\Web\Input;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
class UpdateInputRequest extends FormRequest
{
   protected $alphaexpr='/^[\pL\s\_\-]+$/u';

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
         'field_name_edit'=>'required|string|regex:'.$this->alphaexpr, 
        'field_type_edit'=>'required|in:text,bool,list,date,longtext', 
        
        'field_tooltipe_edit'=>'required|string|regex:'.$this->alphaexpr,  
          'field_icon_edit' =>File::types(['svg']),   
          
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
      'field_name_edit.required'=> __('messages.this field is required') ,       
      'field_type_edit.required'=> __('messages.this field is required') ,  
     'field_type_edit.in' => __('messages.this field is required') , 
      'field_tooltipe_edit.required'=> __('messages.this field is required') ,      
      'field_icon_edit'=>__('messages.file must be svg') ,
      'field_name_edit.regex'=>__('messages.must be alpha') ,
      'field_tooltipe_edit.regex'=>__('messages.must be alpha') ,
    ];
    
}

}
