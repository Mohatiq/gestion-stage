<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Vérifie que l'utilisateur est bien le propriétaire de l'offre
        $offre = $this->route('offre'); // récupère l'offre depuis l'URL
        return auth()->id() === $offre->societe_id;
    }

    public function rules(): array
    {
        return [
            'titre'        => 'required|string|max:255',
            'description'  => 'required|string|min:20',
            'ville'        => 'required|string|max:100',
            'duree'        => 'required|integer|min:1|max:24',
            'remuneration' => 'nullable|numeric|min:0',
            'date_limite'  => 'nullable|date',
        ];
    }
}