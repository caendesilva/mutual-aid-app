<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Request::class);
    }


    /**
     * Set the user ID to the request user ID
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->request->add(['user_id'=> Auth::id()]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'exists:App\Models\User,id',
            'subject' => 'required|string|max:64',
            'location' => 'required|string|max:255',
            'body' => 'nullable|string|max:2048',
            'expires_at' => 'nullable|date',
            'resources' => 'nullable|array',
        ];
    }
}
