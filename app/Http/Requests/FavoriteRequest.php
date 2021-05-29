<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
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
            'favoritable_id' => current($this->route()->parameters()),
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
            'favoritable_id' => ["exists:{$this->segment(2)},id"],
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'favoritable_type' => 'App\Models\\' . ucfirst($this->route()->parameterNames()[0]),
        ]);
    }
}
