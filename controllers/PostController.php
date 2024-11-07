<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Post;
use app\models\Media;

class PostController extends Controller
{
    public function create(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $post = new Post();
            $post->description = $request->getBody()['description'] ?? '';
            $post->tech_id = Application::$app->technician->tech_id; // assuming technician is logged in

            if ($post->save()) {
                // Handle media upload if a file is uploaded
                if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
                    $media = new Media();
                    $media->post_id = $post->post_id; // Saved post ID
                    $media->media_type = $_FILES['media']['type'];

                    $targetDir = Application::$ROOT_DIR . '/public/uploads/';
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $fileName = time() . '_' . basename($_FILES['media']['name']);
                    $filePath = $targetDir . $fileName;

                    if (move_uploaded_file($_FILES['media']['tmp_name'], $filePath)) {
                        $media->media_url = '/uploads/' . $fileName;
                        $media->uploaded_at = date('Y-m-d H:i:s');
                        $media->save();
                    }
                }

                Application::$app->session->setFlash('success', 'Post created successfully.');
            }

            $response->redirect('/technician-community');
        }

        // Load posts to display on the same page
        $posts = Post::getAllWithMedia();
        return $this->render('technician-community', [
            'posts' => $posts
        ]);
    }
}
