<?php

namespace Models;

class Comment extends Model
{
    protected $table = "comments";

    /**
     * Return comments by article_id order by creation date
     *
     * @param integer $article_id
     * @return array
     */
    public function findAllBy(int $article_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id ORDER BY created_at DESC");
        $query->execute(['article_id' => $article_id]);
        $comments = $query->fetchAll();

        return $comments;
    }

    /**
     * insert a comment in the database
     *
     * @param string $author
     * @param string $content
     * @param integer $article_id
     * @return void
     */
    public function insert(string $author, string $content, int $article_id): void
    {
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
