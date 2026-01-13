<?php

namespace App\Models;

use App\Enums\CategoryEnum;
use App\Enums\DifficultyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'image',
        'temps_preparation',
        'nb_personnes',
        'categorie',
        'difficulte',
    ];

    protected function casts(): array
    {
        return [
            'categorie' => CategoryEnum::class,
            'difficulte' => DifficultyEnum::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function etapes(): HasMany
    {
        return $this->hasMany(Etape::class);
    }

    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favoris')
            ->withTimestamps();
    }
}
