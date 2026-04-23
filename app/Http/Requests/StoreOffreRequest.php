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
    public function messages(): array
    {
        return [
            'titre.required'       => 'Le titre est obligatoire.',
            'description.min'      => 'La description doit faire au moins 20 caractères.',
            'duree.max'            => 'La durée ne peut pas dépasser 24 mois.',
            'date_limite.after'    => 'La date limite doit être dans le futur.',
        ];
    }
}
