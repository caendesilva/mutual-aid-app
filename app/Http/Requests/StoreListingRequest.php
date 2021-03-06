<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
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
            'contacts' => 'nullable|string|max:128',
            'body' => 'nullable|string|max:2048',
            'resources' => 'nullable|array',
            'type' => 'required|string|in:request,offer',
            'is_religious' => 'nullable|boolean',
        ];
    }
}
