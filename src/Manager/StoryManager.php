<?php

namespace App\Manager;

use App\Repository\StoryRepository;

class StoryManager
{
    private StoryRepository $storyRepository;

    public function __construct()
    {
        $this->storyRepository = new StoryRepository();
    }

    public function getAllStory(): array
    {
        return $this->storyRepository->findAll();
    }

    public function remove(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM story WHERE id = :id");
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();
    }

    public function push(Story $story)
    {
        try {
            $title = $story->getTitle();
            $summary = $story->getSummary();
            $published = $story->isPublished(); // Suppose que c'est un booléen
            $numberReadings = $story->getNumberReadings();
            $createdAt = $story->getCreatedAt()->format('Y-m-d H:i:s');
            $userId = $story->getUserId();
            $categoryId = $story->getCategoryId();

            $query = $this->pdo->prepare(
                'INSERT INTO story (title, summary, published, number_readings, created_at, id_user, id_category)
                 VALUES (:title, :summary, :published, :number_readings, :created_at, :id_user, :id_category)'
            );

            $query->bindParam(':title', $title, \PDO::PARAM_STR);
            $query->bindParam(':summary', $summary, \PDO::PARAM_STR);
            $query->bindParam(':published', $published, \PDO::PARAM_INT);
            $query->bindParam(':number_readings', $numberReadings, \PDO::PARAM_INT);
            $query->bindParam(':created_at', $createdAt, \PDO::PARAM_STR);
            $query->bindParam(':id_user', $userId, \PDO::PARAM_INT);
            $query->bindParam(':id_category', $categoryId, \PDO::PARAM_INT);

            $query->execute();
        } catch (\PDOException $e) {
            die("Erreur lors de l'insertion : " . $e->getMessage());
        }
    }
}

}