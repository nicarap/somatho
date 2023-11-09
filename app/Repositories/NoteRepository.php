<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Note;
use App\Models\User;
use App\Models\Traitment;

class NoteRepository
{
    public function create(Traitment|User $model, array $attributes): Note
    {
        $note = Note::make($attributes);
        $note->notable()->associate($model);

        return $this->save($note);
    }

    public function save(Note $note)
    {
        $note->save();

        return $note;
    }
}
