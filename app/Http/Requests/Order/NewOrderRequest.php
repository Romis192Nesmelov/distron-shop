<?php

namespace App\Http\Requests\Order;

use App\Http\Controllers\HelperTrait;
use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
{
    use HelperTrait;

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
            'phone' => $this->validationPhone,
            'address' => 'nullable|min:3|max:255',
            'delivery' => 'in:0,1',
            'notes' => $this->validationText
        ];
    }
}
