<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class StoreOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === 'societe';
    }

    public function rules(): array
    {
        return [
            'titre'        => 'required|string|max:255',
            'description'  => 'required|string|min:20',
            'ville'        => 'required|string|max:100',
            'duree'        => 'required|integer|min:1|max:24',
            'remuneration' => 'nullable|numeric|min:0',
            'date_limite'  => 'nullable|date|after:today',
        ];
    }
}
