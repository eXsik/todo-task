<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in-progress,done',
            'expiration_date' => 'required|date|after_or_equal:today'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nazwa zadania jest wymagana.',
            'name.max' => 'Nazwa zadania nie może przekraczać 255 znaków.',
            'expiration_date.after_or_equal' => 'Termin wykonania zadania musi być dniej dzisiejszym lub późniejszym.'
        ];
    }
}
