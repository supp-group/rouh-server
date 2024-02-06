<?php

namespace App\Http\Requests\Api\ValueService;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
         'inputservice_id'=>'required|integer', 
         'selectedservice_id'=>'required|integer',        
         'image_1'=>'nullable|file|image',
         'image_2'=>'nullable|file|image',
         'image_3'=>'nullable|file|image',
         'image_4'=>'nullable|file|image',
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
      'inputservice_id.required'=>'this field is required' ,
      'inputservice_id.integer'=>'messages must be integer' ,
      'selectedservice_id.required'=> 'this field is required',
      'selectedservice_id.integer'=>'messages must be integer' ,
     
      'image_1'=>'file must be image' ,
      'image_2'=>'file must be image' ,
      'image_3'=>'file must be image' ,
      'image_4'=>'file must be image' ,
    ];
    
}

}
