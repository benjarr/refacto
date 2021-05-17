<?php

namespace Controllers;

class Comment extends Controller
{
    // $className: "\Models\Comment" or \Models\Comment::class;
    protected $className = \Models\Comment::class;

    public function insert()
    {
        $articleModel = new \Models\Article();

        /**
         * 1. We check that the data has been sent in POST
         * First, we get the information from POST
         * Then we check that they are not null
         */
        // We start with the author
        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        // Then the content
        $content = null;
        if (!empty($_POST['content'])) {
            // We are still careful that the guy does not try weird tags in his comment
            $content = htmlspecialchars($_POST['content']);
        }

        // Finally the article id
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        // Final verification of the information sent in the form
        // If there is no author OR there is no content OR there is no article id
        if (!$author || !$article_id || !$content) {
            die("Your form was incorrectly completed!");
        }

        $article = $articleModel->find($article_id);
        // If nothing came back, we made a mistake
        if (!$article) {
            die("Ho! The article $article_id does not exist boloss!");
        }

        /**
         * 3. Comment insertion
         */
        $this->model->insert($author, $content, $article_id);

        /**
         * 4. Redirection to the article in question
         */
        \Http::redirect("index.php?controller=article&task=show&id=" . $article_id);
    }

    public function delete()
    {
        /**
         * 1. Retrieving the "id" in GET
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho! Had to specify the id parameter in GET!");
        }

        $id = $_GET['id'];

        /**
         * 3. Check that the comment exist
         */
        $comment = $this->model->find($id);
        if (!$comment) {
            die("Item $id does not exist, so you cannot delete it!");
        }

        /**
         * 4. Real suppression of the comment
         */
        $article_id = $comment['article_id'];

        $this->model->delete($id);

        /**
         * 5. Redirection to the article in question
         */
        \Http::redirect("index.php?controller=article&task=show&id=" . $article_id);
    }
}
