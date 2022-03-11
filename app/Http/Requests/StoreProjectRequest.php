<?php

namespace App\Http\Requests;

use App\Actions\ProjectValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/** @deprecated */
class StoreProjectRequest extends FormRequest
{
    use ProjectValidationRules;

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
        return $this->baseRules();
    }
}
