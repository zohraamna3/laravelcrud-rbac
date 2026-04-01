<?php

namespace App\Http\Requests;

use App\Rules\ImageSize;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ImageValidateRequest extends FormRequest
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
            'images' => 'required|array',
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048', new ImageSize],
            ];
    }

    public function messages()
    {
        return [
            'images.array' => 'Images must be an array.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be a JPG, JPEG, or PNG file.',
            'images.*.max' => 'Each image size must be less than 2MB.',
        ];
    }
}
