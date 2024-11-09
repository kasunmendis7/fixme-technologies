<?php
/* Post CRUD Operations */

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\Post;
use app\core\Request;

class PostController extends Controller
{
    /* Create method of a post */
    public function create(Request $request)
    {
        $post = new Post();

        // Fetch logged-in technician's ID from session
        $techID = Application::$app->session->get('technician');
        if ($techID) {
            $post->tech_id = $techID;
        } else {
            // Set flash message and redirect if not logged in
            Application::$app->session->setFlash('error', 'You must be logged in to create a post.');
            Application::$app->response->redirect('/technician-login');
            return;
        }

        if ($request->isPost()) {
            $post->loadData($request->getBody());

            if ($post->validate() && $post->save()) {
                Application::$app->session->setFlash('success', 'Post uploaded successfully!');
                Application::$app->response->redirect('/technician-community');
                return;
            }
        }

        return $this->render('/technician/technician-create-post', [
            'model' => $post
        ]);
    }

    /* Retrieve method of a post */
    public function index()
    {
        $posts = Post::getAllPosts();  // Fetch all posts from the database
        $this->setLayout('auth');
        return $this->render('/technician/technician-community', [
            'posts' => $posts
        ]);
    }

    /* * Update method of a post */
    public function edit(Request $request)
    {
        // Fetch the post ID from the request and find the post
        $postID = $request->getBody()['post_id'] ?? null;
        $post = Post::findOne(['post_id' => $postID]);

        if (!$post) {
            Application::$app->session->setFlash('error', 'Post not found.');
            Application::$app->response->redirect('/technician-community');
            return;
        }

        // Fetch the logged-in technician's ID from the session
        $techID = Application::$app->session->get('technician');
        if ($post->tech_id !== $techID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/technician-community');
            return;
        }

        if ($request->isPost()) {
            $post->loadData($request->getBody());

            // Check if a new media file is uploaded
            if (!empty($_FILES['media']['name'])) {
                $post->media = $_FILES['media']['name'];
                move_uploaded_file($_FILES['media']['tmp_name'], 'assets/uploads/' . $post->media);
            }

            if ($post->validate() && $post->editPost()) {
                Application::$app->session->setFlash('success', 'Post updated successfully!');
                Application::$app->response->redirect('/technician-community');
                return;
            }
        }

        return $this->render('/technician/technician-edit-post', [
            'post' => $post
        ]);
    }

    /* Delete method of a post */


}

