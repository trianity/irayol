<?php

namespace Modules\Courses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title_class' => 'required|string|min:1|max:255',
            'note' => 'required|string|min:1|max:255',
            'media_type' => 'required',
            'url' => 'required|string|min:1|max:255',
            'duration' => 'required',
            'access' => 'required',
            'is_active' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
