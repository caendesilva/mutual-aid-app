<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // We check authorization in the resource controller
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|string|max:64',
            'location' => 'required|string|max:255',
            'body' => 'nullable|string|max:2048',
            'expires_at' => 'nullable|date',
            'resources' => 'nullable|array',
        ];
    }
}
