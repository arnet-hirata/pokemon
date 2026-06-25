<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
                'name' => ['required','string','min:3','max:50'],
                'price' => ['required','integer','min:1'],
                'category_id' => ['required'],
                'release_date'=> ['date','required','before_or_equal:today'],
                'text'=> ['required','min:5','string'],
                'stock' => ['required','min:0','integer'],
        ];
    }
}
