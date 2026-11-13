<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // only users with an author profile may post (residents get 403)
        return $this->user() !== null && $this->user()->author()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:120'],
            'body'         => ['required', 'string', 'min:20'],
            'category'     => ['required', Rule::in(Post::CATEGORIES)],
            'tags'         => ['required', 'array', 'min:1'],
            'tags.*'       => ['exists:tags,id'],
            'is_published' => ['boolean'],
        ];
    }
}
