<?php

require_once('libraries/models/Model.php');

class Article extends Model
{
    /**
     * Return articles order by creation date
     *
     * @return array
     */
    public function findAll(): array
    {
        $results = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        $articles = $results->fetchAll();

        return $articles;
    }

    /**
     * Return article by id or false if id doesn't found
     *
     * @param integer $id
     * @return array|bool
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
        $query->execute(['article_id' => $id]);
        $article = $query->fetch();

        return $article;
    }

    /**
     * Delete article from Database
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}
