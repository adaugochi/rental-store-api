<?php

namespace App\Http\Requests;

use App\Models\Rent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

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
        $userExist = Rule::exists('users', 'id')->where(function ($query) {
            return $query->where('id', $this->user_id);
        });

        return [
            'user_id' => ['required', $userExist],
            'rent_type' => 'required|string',
            'status' => 'required_if:status,==,null|string|in:' . Rent::RETURNED . ',' . Rent::RENTED
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'success' => false,
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
