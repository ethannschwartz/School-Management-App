<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->account_type === 'teacher';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'         => ['required', 'string', 'max:255'],
            'code'          => ['required', 'string', 'max:24'],
            'section'       => ['required', 'string', 'max:24'],
            'description'   => ['required', 'string', 'max:255'],
        ];
    }
}
