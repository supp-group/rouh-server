<?php

namespace App\Http\Requests\Web\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormStateRequest extends FormRequest
{
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
         'form_state'=>'required|in:agree,reject', 
         'form_reject_reason'=>'exclude_unless:form_state,reject|required|integer', //exclude_if
        
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
      'form_state.required'=> __('messages.this field is required')  ,
      'form_state.in'=> __('messages.this field is required')  ,
      'form_reject_reason.required'=>  __('messages.this field is required') ,
      'form_reject_reason.integer'=>  __('messages.this field is required') ,     
 
    ];
    
}
}
