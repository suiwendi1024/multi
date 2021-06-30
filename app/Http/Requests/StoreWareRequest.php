<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWareRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'numeric', 'max:999', 'min:1'],
            'is_selected' => ['required', 'bool'],
        ];
    }

    protected function passedValidation()
    {
        $product = \App\Models\Product::find($this->product_id);

        $this->merge([
            'subject_type' => \Auth::user()->getMorphClass(),
            'subject_id' => \Auth::id(),
            'amount' => $product->price * $this->quantity,
        ]);
    }
}
