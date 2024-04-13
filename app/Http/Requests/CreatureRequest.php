<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'              => 'required|min:1|max:50|unique:creatures,name',
            'img'               => 'required|unique:creatures,img',
            'mythology'         => 'required',
            'habitat'           => 'required',
            'short_description' => 'required|min:1|max:100',
            'description'       => 'required|min:1|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 =>'Название обязательное поле.',
            'img.required'                  =>'Название фото/картинки обязательное поле.',
            'short_description.required'    =>'Краткое описание обязательное поле.',
            'description.required'          =>'Описание обязательное поле.'
        ];
    }
}
