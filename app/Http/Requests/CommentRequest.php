<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'commentable_id' => current($this->route()->parameters()),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commentable_id' => ['required', "exists:{$this->segment(2)},id"],
            'body' => [$this->isMethod('post') ? 'required' : 'filled', 'max:2000']
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'commentable_type' => 'App\Models\\' . ucfirst($this->route()->parameterNames()[0]),
        ]);
    }
}
