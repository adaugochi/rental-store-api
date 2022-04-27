<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed $user_id
 */
class RentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userExist = Rule::exists('users')->where(function ($query) {
            return $query->where('id', $this->user_id);
        });

        return [
            'user_id' => ['required', $userExist],
            'rent_type' => 'required|string',
            'status' => 'required|string'
        ];
    }
}
