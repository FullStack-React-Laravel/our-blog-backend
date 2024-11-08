<?php

namespace App\Http\Requests\API\V1;

use App\Models\Post;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use function Laravel\Prompts\error;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $post = $this->route('post'); // receives the post parameter from update route  
        return [
            // explain the unique rule  : [unique:table , column , ignore ] 
            //the ignore attribute will make this recored unique comparing with all other records in database except the ignore condition (the record itself in this case)
            'title' => 'required|min:5|max:50|string|unique:posts,title,' . $post->id,
            'attachment' => 'sometimes|filled|max:2048|mimes:jpeg,png,jpg,gif,mp4', //2mb
            'content' => 'required|min:20|string',
            'category_id' => 'sometimes'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation errors',
            'error' => $validator->errors()
        ], 422));
    }
    public function prepareForValidation()
    {
        $newTitle = $this->input('title');
        $originalTitle = $this->route('post')->title;

        $newTitle !== $originalTitle ? $this->merge(
            [
                'slug' => str()->slug($this->input('title'))
            ]
        ) : '';

        $newContent = $this->input('content');
        $originalContent = $this->route('post')->content;

        $newContent !== $originalContent ?
            $this->merge(
                [
                    'excerpt' => substr($this->input('content'), 0, 9),
                ]
            ) : '';
    }
}
