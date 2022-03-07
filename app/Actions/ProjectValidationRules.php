<?php

namespace App\Actions;

trait ProjectValidationRules
{
    /**
     * Get the base validation rules used validate projects.
     *
     * @return array
     */
	public function baseRules()
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
