<?php

namespace App\Http\Requests\API\V1;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;


class StorePostRequest extends FormRequest
{
    protected $redirect = null;
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
            'title' => 'required|min:5|max:50|string|unique:posts,title',
            'attachment' => 'sometimes|filled|max:2048|mimes:jpeg,png,jpg,gif,mp4', //2mb
            'content' => 'required|min:20|string',
            'category_id' => 'required'
        ];
    }
    public function prepareForValidation(): void
    {
        $this->merge([
            'slug' => str()->slug($this->title),
            'excerpt' => substr($this->input('content'), 0, 9),
            'user_id' => auth()->id(),
        ]);
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ],
                422
            )
        );
    }
}
