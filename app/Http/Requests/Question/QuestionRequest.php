<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    private array $questionValidationRules =  ['required', 'string', 'min:1'];
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
            'question' => $this->questionValidationRules,
            'correct' => $this->questionValidationRules,
            "answer1" => $this->questionValidationRules,
            "answer2" => $this->questionValidationRules,
            "answer3" => $this->questionValidationRules,
            "answer4" => $this->questionValidationRules
        ];
    }
}
