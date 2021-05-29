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
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'max:40'],
            'body' => ['required', 'max:20000'],
            'cover' => ['required', 'dimensions:min_width=800,min_height=600'],
            'summary' => ['required', 'max:200'],
        ];

        if ($this->isMethod('patch')) {
            $required_rules = array_keys(array_filter($rules, function ($rule) {
                return in_array('required', $rule);
            }));

            foreach ($rules as $key => &$rule) {
                if (in_array('required', $rule)) {
                    $others = join(',', array_filter($required_rules, function ($required_key) use ($key) {
                        return $required_key != $key;
                    }, ARRAY_FILTER_USE_KEY));

                    array_splice($rule, array_search('required', $rule), 1, ['filled', 'required_without_all:' . $others]);
                }
            }
        }

        return $rules;
    }

    protected function passedValidation()
    {
        $input = [
            'user_id' => auth()->id(),
        ];

        if ($this->cover) {
            $input['cover_url'] = $this->file('cover')->store('images');
        }

        $this->merge($input);
    }
}
