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
            'title' => 'required|min:5|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '标题必须填写',
            'title.min'  => '标题最小5字节',
            'title.max'  => '标题最长255字节',
        ];
    }
}
