<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationSettingsUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'APP_NAME' => 'required|min:3|max:30',
            'APP_URL' => 'required|url',
            'APP_EMAIL' => 'required|email',
            'APP_FROM' => 'required|min:3|max:55',
            'APP_REGISTER' => 'required',
            'APP_EDITOR' => 'required',
            'APP_LOCALE' => 'required',
        ];
    }
}
