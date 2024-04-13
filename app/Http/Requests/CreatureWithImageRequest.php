<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatureWithImageRequest extends FormRequest
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
        return [
            'name'                  => 'required|min:1|max:50|unique:creatures,name',
            'img_name'              => 'required|min:1|max:20',
            'image'                 => 'required',
            'mythology'             => 'required',
            'habitat'               => 'required',
            'short_description'     => 'required|min:1|max:50',
            'description'           => 'required|min:1|max:500',
        ];
    }
}
