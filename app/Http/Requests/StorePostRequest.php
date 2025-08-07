<?php

namespace App\Http\Requests\Post;

use App\Enums\PostType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => [
                'string',
                'required',
                'max:200',
            ],
            'content' => [
                'string',
                'required',
                'max:500',
            ],
            'type' => [
                'string',
                'required',
                new Enum(PostType::class),
            ],
            'is_exclusive' => [
                'boolean',
                'nullable',
            ],
        ];
    }
}
