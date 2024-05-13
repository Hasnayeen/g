<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Project extends Model
{
    use HasFactory;

    public function teams(): MorphToMany
    {
        return $this->morphToMany(Team::class, 'projectable');
    }

    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'projectable');
    }

    public function members(): Collection
    {
        return collect([$this->posts, $this->videos])->flatten();
    }

    public function note(): MorphOne
    {
        return $this->morphOne(Note::class, 'noteable');
    }
}
