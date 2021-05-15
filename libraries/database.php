<?php

/**
 * Returns a connection to the database
 *
 * @return PDO
 */
function getPdo(): PDO
{
    $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    return $pdo;
}

/**
 * Return articles order by creation date
 *
 * @return array
 */
function findAllArticles(): array
{
    $results = getPdo()->query('SELECT * FROM articles ORDER BY created_at DESC');
    $articles = $results->fetchAll();

    return $articles;
}

/**
 * Return article by id or false if id doesn't found
 *
 * @param integer $id
 * @return array|bool
 */
function findArticle(int $id)
{
    $query = getPdo()->prepare("SELECT * FROM articles WHERE id = :article_id");
    $query->execute(['article_id' => $id]);
    $article = $query->fetch();

    return $article;
}

/**
 * Return comments by article_id or boolean if article_id doesn't found
 *
 * @param integer $article_id
 * @return array
 */
function findAllComments(int $article_id): array
{
    $query = getPdo()->prepare("SELECT * FROM comments WHERE article_id = :article_id ORDER BY created_at DESC");
    $query->execute(['article_id' => $article_id]);
    $comments = $query->fetchAll();

    return $comments;
}

/**
 * Delete article from Database
 *
 * @param integer $id
 * @return void
 */
function deleteArticle(int $id): void
{
    $query = getPdo()->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}

/**
 * Return comment by id or boolean if id doesn't found
 *
 * @param integer $id
 * @return array|bool
 */
function findComment(int $id)
{
    $query = getPdo()->prepare('SELECT * FROM comments WHERE id = :id');
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
function deleteComment(int $id): void
{
    $query = getPdo()->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
}

function insertComment(string $author, string $content, int $article_id): void
{
    $query = getPdo()->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    $query->execute(compact('author', 'content', 'article_id'));
}
