<?php

namespace Controllers;

require_once('libraries/utils.php');

class Article extends Controller
{
    // $className: "\Models\Article" or \Models\Article::class;
    protected $className = \Models\Article::class;
    
    public function index()
    {
        /**
         * 2. Find all articles order by creation date
         */
        $articles = $this->model->findAll("created_at DESC");

        /**
         * 3. Display
         */
        $pageTitle = "Home";

        render('articles/index', compact('pageTitle', 'articles'));
    }

    public function show()
    {
        $commentModel = new \Models\Comment();

        /**
         * 1. Retrieving the "id" and verifying it
         */
        // We assume that we do not have an "id"
        $article_id = null;

        // But if there is one and it is an integer, so that's cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        // We can now decide: error or not?!
        if (!$article_id) {
            die("You must specify an `id` parameter in the URL!");
        }

        /**
         * 3. Retrieving the article where id = article_id
         */
        $article = $this->model->find($article_id);
        if (!$article) {
            die("Article $article_id doen't exist!");
        }

        /**
         * 4. Retrieving comments by article_id
         */
        $comments = $commentModel->findAllBy($article_id);

        /**
         * 5. Display
         */
        $pageTitle = $article['title'];

        render('articles/show', compact('pageTitle', 'article', 'comments', 'article_id'));
    }

    public function delete()
    {
        /**
         * 1. We check that GET have an "id" and it is a number
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! You did not specify the article id!");
        }

        $id = $_GET['id'];

        /**
         * 3. Check that the article exist
         */
        $article = $this->model->find($id);
        if (!$article) {
            die("Item $id does not exist, so you cannot delete it!");
        }

        /**
         * 4. Real suppression of the article
         */
        $this->model->delete($id);

        /**
         * 5. Redirection to the home page
         */
        redirect('index.php');
    }
}
