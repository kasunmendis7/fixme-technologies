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
        if ($request->isPost()) {
            $comment = new Comment();
            $comment->loadData($request->getBody());

            // Set the logged-in user's ID as the comment owner
            $comment->cus_id = Application::$app->customer->cus_id;

            if ($comment->validate() && $comment->save()) {
                Application::$app->session->setFlash('success', 'Comment posted successfully');
            } else {
                Application::$app->session->setFlash('error', 'Failed to post comment');
            }

            Application::$app->response->redirect('/fixme-community');

        }
    }

    /* The Comments are retrieved along with the posts in the Post Controller */

    // Edit an existing comment
    public function edit(Request $request)
    {
        $comment_id = $request->getBody()['comment_id'];
        $comment = (new Comment)->findOne(['comment_id' => $comment_id]);

        // Ensure the user is the owner of the comment
        if ($comment->cus_id !== Application::$app->customer->cus_id) {
            Application::$app->session->setFlash('error', 'Unauthorized action');
            $this->response->redirect("/fixme-community");
            return;
        }

        if ($request->isPost()) {
            $comment->loadData($request->getBody());

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
        $cusID = Application::$app->customer->cus_id; // Get the logged-in customer ID

        if (!$commentID || !$cusID) {
            Application::$app->session->setFlash('error', 'Invalid request.');
            Application::$app->response->redirect('/fixme-community');
            return;
        }

        // Find the comment by ID
        $comment = (new Comment)->findOne(['comment_id' => $commentID]);

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

        Application::$app->response->redirect('/fixme-community');
    }

}
