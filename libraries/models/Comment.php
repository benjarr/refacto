<?php

require_once('libraries/models/Model.php');

class Comment extends Model
{
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
     * Return comment by id or boolean if id doesn't found
     *
     * @param integer $id
     * @return array|bool
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment = $query->fetch();

        return $comment;
    }

    /**
     * Delete comment from Database
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
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
