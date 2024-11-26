<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Comment;

class CommentController extends Controller
{
    // Create a new comment
    public function create(Request $request)
    {
        // Checks if the HTTP request method is POST
        if ($request->isPost()) {
            // Create a new instance of the Comment model, used to store and handle data of the new comment
            $comment = new Comment();
            // The loadData method populates the Comment instance with the data from the POST request
            $comment->loadData($request->getBody());

            // Set the logged-in user's ID as the comment owner
            $comment->cus_id = Application::$app->customer->cus_id;
            // Validate the data before saving it
            if ($comment->validate() && $comment->save()) {
                Application::$app->session->setFlash('success', 'Comment posted successfully');
            } else {
                Application::$app->session->setFlash('error', 'Failed to post comment');
            }
            // Redirects the user to the fixmecommunity page after attempting to create the comment
            Application::$app->response->redirect('/fixme-community');

        }
    }

    /* The Comments are retrieved along with the posts in the Post Controller */

    // Edit an existing comment
    public function edit(Request $request)
    {
        // Fetch the comment ID from the request and find the comment
        $comment_id = $request->getBody()['comment_id'];
        // Retrives the comment from the database
        $comment = (new Comment)->findOne(['comment_id' => $comment_id]);

        // Ensure the user is the owner of the comment
        if ($comment->cus_id !== Application::$app->customer->cus_id) {
            Application::$app->session->setFlash('error', 'Unauthorized action');
            $this->response->redirect("/fixme-community");
            return;
        }
        // Checks if the HTTP request is a POST request
        if ($request->isPost()) {
            // Updates the Comment object with the new values provided by the user.
            $comment->loadData($request->getBody());
            // Validate the updated data before saving it
            if ($comment->validate() && $comment->update()) {
                Application::$app->session->setFlash('success', 'Comment updated successfully');
            } else {
                Application::$app->session->setFlash('error', 'Failed to update comment');
            }

            Application::$app->response->redirect('/fixme-community');
        }

        // Render the edit comment view
        return $this->render('/customer/fixme-community', [
            'comment' => $comment
        ]);
    }

    // Delete a comment
    public function delete(Request $request)
    {
        // Fetch the comment ID from the request
        $commentID = $request->getBody()['comment_id'] ?? null;
        // Get the logged-in customer's ID
        $cusID = Application::$app->customer->cus_id; // Get the logged-in customer ID
        // Check if the comment ID or customer ID is not set (invalid request)
        if (!$commentID || !$cusID) {
            Application::$app->session->setFlash('error', 'Invalid request.');
            Application::$app->response->redirect('/fixme-community');
            // Stop the execution of the method
            return;
        }

        // Find the comment using its ID
        $comment = (new Comment)->findOne(['comment_id' => $commentID]);
        // Check if the comment does not exist
        if (!$comment) {
            Application::$app->session->setFlash('error', 'Comment not found.');
            Application::$app->response->redirect('/fixme-community');
            return;
        }

        // Check if the logged-in customer is the owner of the comment
        if ($comment->cus_id !== $cusID) {
            Application::$app->session->setFlash('error', 'Unauthorized access.');
            Application::$app->response->redirect('/fixme-community');
            return;
        }

        // Call the delete method from the Comment model
        if ((new Comment)->deleteComment($commentID, $cusID)) {
            Application::$app->session->setFlash('success', 'Comment deleted successfully!');
        } else {
            Application::$app->session->setFlash('error', 'Failed to delete the comment.');
        }
        // Redirect the user to the '/fixmecommunity' page after the operation
        Application::$app->response->redirect('/fixme-community');
    }

}
