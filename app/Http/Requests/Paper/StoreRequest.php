<?php

namespace App\Http\Requests\Paper;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|min:5|max:200',
            'subtitle' => 'required|min:5|max:200',
            'attachment' => 'required|mimes:docx',
        ];
    }
    
    public function getPaper()
    {
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
        ];
    }
    
    public function getDocument()
    {
        return [
            'attachment' => $this->attachment->storePublicly('document', 'public'),
        ];
    }
}
