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

        // Fetch logged-in technician's tech_id from session
        $techID = Application::$app->session->get('technician');
        // Check if techID exists to confirm that the technician is logged in to create a new post
        if ($techID) {
            // Assign technician's id to tech_id attribute of the Post model
            $post->tech_id = $techID;
        } else {
            // Set flash message and redirect if not logged in
            Application::$app->session->setFlash('error', 'You must be logged in to create a post.');
            Application::$app->response->redirect('/technician-login');
            return;
        }
        // Checks if the HTTP request is a POST request
        if ($request->isPost()) {
            // Retrieves the form data and fills the Post model with incoming data for validation and saving
            $post->loadData($request->getBody());
            // Validates the data and saves the data on the database
            if ($post->postValidate() && $post->save()) {
                Application::$app->session->setFlash('success', 'Post uploaded successfully!');
                Application::$app->response->redirect('/technician-community');
                return;
            }
        }
        // Renders the view and passes the Post model instance to the view
        return $this->render('/technician/technician-create-post', [
            'model' => $post
        ]);
    }

    /* Retrieve method of a post */
    public function index()
    {
        // Fetch all the posts with likes along with the person's data
        $posts = (new Post)->getAllPostsWithLikes(Application::$app->customer->cus_id);
        // The reference operator(&) modifies the $post array directly during the loop
        foreach ($posts as &$post) {
            // Get all the comments relavent to the post
            $post['comments'] = (new Comment)->getAllComments($post['post_id']);
        }
        // Renders the view
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
        // Finds the post with the corresponding post_id in order to edit it
        $post = (new Post)->findOne(['post_id' => $postID]);
        // If find one method returns null, a flash message saying 'Post not found" will appear
        if (!$post) {
            Application::$app->session->setFlash('error', 'Post not found.');
            Application::$app->response->redirect('/technician-community');
            return;
        }

        // Fetch the logged-in technician's ID from the session
        $techID = Application::$app->session->get('technician');
        // If the logged in technician id and the person who added the post are different
        if ($post->tech_id !== $techID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/technician-community');
            return;
        }
        // Check is current request is a POST request
        if ($request->isPost()) {
            // Populates the Post model with updated data from the request.
            $post->loadData($request->getBody());

            // Check if a new media file is uploaded
            if (!empty($_FILES['media']['name'])) {
                // Stores the uploaded file's name in the media property of the Post model.
                $post->media = $_FILES['media']['name'];
                move_uploaded_file($_FILES['media']['tmp_name'], 'assets/uploads/' . $post->media);
            }
            // Validates the requirements before editing the post
            if ($post->postValidate() && $post->editPost()) {
                // Sets a success flash message and redirects the user to the technician community page
                Application::$app->session->setFlash('success', 'Post updated successfully!');
                Application::$app->response->redirect('/technician-community');
                return;
            }
        }
        // Passes the current post data to the view for display in the form
        return $this->render('/technician/technician-edit-post', [
            'post' => $post
        ]);
    }

    /* Delete method of a post */
    public function delete(Request $request)
    {
        // Fetch the post ID from the request
        $postID = $request->getBody()['post_id'] ?? null;
        // Retrieves the logged-in technician’s ID from the session
        $techID = Application::$app->session->get('technician');

        if (!$postID || !$techID) {
            Application::$app->session->setFlash('error', 'Invalid request.');
            Application::$app->response->redirect('/technician-community');
            return;
        }
        // Retrieves a post with the given post_id
        $post = (new Post)->findOne(['post_id' => $postID]);

        if (!$post) {
            Application::$app->session->setFlash('error', 'Post not found.');
            Application::$app->response->redirect('/technician-community');
            return;
        }
        // No access if logged tech_id is not equal to the tech_id of the post
        if ($post->tech_id !== $techID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/technician-community');
            return;
        }
        // Deletes the post from the database and returns true if successful, false otherwise
        if ((new Post)->deletePost($postID, $techID)) {
            Application::$app->session->setFlash('success', 'Post deleted successfully!');
        } else {
            Application::$app->session->setFlash('error', 'Failed to delete the post.');
        }
        // Redirects the user to the technician community page
        Application::$app->response->redirect('/technician-community');
    }

    //$request: An object representing the current HTTP request, containing request data.
    //$response: An object for preparing the HTTP response, including returning JSON data.
    public function like(Request $request, Response $response)
    {
        // To construct and send the response, such as returning JSON data
        $response = new Response();
        // Identifies which post is being liked
        $postId = $request->getBody()['post_id'];
        // Identifies the customer performing the "like" action
        $customerId = Application::$app->customer->cus_id;

        // Create an instance of the Like model to allow interaction with the database for handling likes
        $likeModel = new Like();
        // Calls the toggleLike method of the Like model, passing the $postId and $customerId as arguments
        $success = $likeModel->toggleLike($postId, $customerId);
        // Get the updated like count
        $likeCount = Like::getLikeCountByPostId($postId);
        // Prepares and sends a JSON response to the client
        return $response->json(['success' => $success, 'like_count' => $likeCount]);
    }


    public function unlike(Request $request, Response $response)
    {
        // This post_id identifies the post that the customer wants to "unlike"
        $postId = $request->getBody()['post_id'];
        // Fetches the logged-in customer’s ID
        $customerId = Application::$app->customer->cus_id;
        // This instance of the model is used to handle the logic for unliking a post
        $likeModel = new Like();
        // Calls the unlikePost method of the Like model, passing the postId (the ID of the post being unliked) and customerId
        $success = $likeModel->unlikePost($postId, $customerId);
        // Update like count after the unlike action
        $likeCount = Like::getLikeCountByPostId($postId);
        // Informs the client about whether the "unlike" action was successful and provides the updated like count for the post.
        return $response->json(['success' => $success, 'like_count' => $likeCount]);
    }


}

