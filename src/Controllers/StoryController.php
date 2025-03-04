<?php

namespace App\Controllers;

use App\Controllers\Controller;

class StoryController extends Controller
{
    private StoryRepository $storyRepository;

    public function __construct()
    {
        $this->storyRepository = new StoryRepository();
    }

    public function resum($id)
    {
        // Récupérer l'histoire spécifique par ID
        $story = $this->storyRepository->findById($id);

        $this->render('story/resum');
    }
}