<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Manager\StoryManager;
use App\Repository\StoryRepository;

class StoryController extends Controller
{
    public function index(StoryRepository $storyRepository, StoryManager $storyManager) {
        $this->render('home/index', ['story' => $stories]);
    }
}