<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

            'title' => 'required|max:100|min:3',
            'image' => 'nullable|image|max:32000',
            'description' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Campo obbligatorio',
            'title.max' => 'Può contenere massimo :max caratteri',
            'title.min' => 'Deve contenere minimo :min caratteri',
            'image.image' => 'Si possono caricare solo file formato immagine',
            'image.max' => 'File immagine troppo grande',
            'description.required' => 'Campo obbligatorio',
            'description.min' => 'Deve contenere minimo :min caratteri',
        ];
    }
}
