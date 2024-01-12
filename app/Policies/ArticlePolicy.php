<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\Therapist;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(Therapist $user)
    {
        return true;
    }

    public function view(Therapist $user, Article $article)
    {
        return true;
    }

    public function create(Therapist $user)
    {
        return true;
    }

    public function update(Therapist $user, Article $article)
    {
        return true;
    }

    public function delete(Therapist $user, Article $article)
    {
        return true;
    }
}
