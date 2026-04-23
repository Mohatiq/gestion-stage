<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'ville',        // était "lieu" avant — on utilise "ville" comme dans la BDD
        'duree',
        'remuneration',
        'date_limite',
        'statut',
        'societe_id',   // était "user_id" avant — on utilise "societe_id" comme dans la BDD
    ];

    public function societe()
    {
        return $this->belongsTo(User::class, 'societe_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}