<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'activity_no' => 'required|exists:activities,activity_no',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'image' => 'nullable|image|mimes:png,jpeg,jpg',
        ];
    }
}
