<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class UserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名字必须填写',
            'name.min'  => '名字最小5字节',
            'name.max'  => '名字最长255字节',
        ];
    }
}
