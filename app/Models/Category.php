<?php
namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Cette classe défini le modèle Eloquent concernant pour la table 'Categories'
 */

class Category extends Model
{
    use HasFactory;

    /**
     * Définit les champs assignables en masse
     * 
     * @var $fillable
     */
    protected $fillable = ['name', 'logo', 'type'];     
    /**
     * Définit la relation OneToMany avec la table 'Questions'
     *      - Une catégorie (table 'categories') concerne zéro ou plusieurs questions (table 'questions') : défini dans le modèle 'Question'
     *      - Une question (table 'questions') est concernée par une et une seulle catégorie (table 'categories') : défini ici
     * 
     * @return HasMany
     */
    public function question(): HasMany 
    {
        return $this->HasMany(Questions::class);
    }
}
