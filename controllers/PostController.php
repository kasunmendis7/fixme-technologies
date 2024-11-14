<?php
/* Post CRUD Operations */

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Response;
use app\models\Like;
use app\models\Post;
use app\models\Comment;
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

            if ($post->PostValidate() && $post->save()) {
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

        $posts = (new Post)->getAllPostsWithLikes(Application::$app->customer->cus_id);
        foreach ($posts as &$post) {
            $post['comments'] = (new Comment)->getAllComments($post['post_id']);
        }
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
        $post = (new Post)->findOne(['post_id' => $postID]);

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

            if ($post->PostValidate() && $post->editPost()) {
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
    public function delete(Request $request)
    {
        // Fetch the post ID from the request
        $postID = $request->getBody()['post_id'] ?? null;
        $techID = Application::$app->session->get('technician');

        if (!$postID || !$techID) {
            Application::$app->session->setFlash('error', 'Invalid request.');
            Application::$app->response->redirect('/technician-community');
            return;
        }

        $post = (new Post)->findOne(['post_id' => $postID]);

        if (!$post) {
            Application::$app->session->setFlash('error', 'Post not found.');
            Application::$app->response->redirect('/technician-community');
            return;
        }

        if ($post->tech_id !== $techID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/technician-community');
            return;
        }

        if ((new Post)->deletePost($postID, $techID)) {
            Application::$app->session->setFlash('success', 'Post deleted successfully!');
        } else {
            Application::$app->session->setFlash('error', 'Failed to delete the post.');
        }

        Application::$app->response->redirect('/technician-community');
    }

    public function like(Request $request, Response $response)
    {
        $response = new Response();
        $postId = $request->getBody()['post_id'];
        $customerId = Application::$app->customer->cus_id;

        $likeModel = new Like();
        $success = $likeModel->toggleLike($postId, $customerId);
        $likeCount = Like::getLikeCountByPostId($postId);

        return $response->json(['success' => $success, 'like_count' => $likeCount]);
    }


    public function unlike(Request $request, Response $response)
    {
        $postId = $request->getBody()['post_id'];
        $customerId = Application::$app->customer->cus_id;

        $likeModel = new Like();
        $success = $likeModel->unlikePost($postId, $customerId);
        $likeCount = Like::getLikeCountByPostId($postId);

        return $response->json(['success' => $success, 'like_count' => $likeCount]);
    }


}

