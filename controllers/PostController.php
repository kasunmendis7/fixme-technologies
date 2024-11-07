<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\Post;
use app\models\Media;

class PostController extends Controller
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post();
            $post->description = $_POST['description'];
            $post->tech_id = Application::$app->technician->tech_id; // assuming the technician is logged in

            if ($post->save()) {
                // Handle media file upload
                if (!empty($_FILES['media']['name'])) {
                    $media = new Media();
                    $media->post_id = $post->post_id;
                    $media->media_type = $_FILES['media']['type'];

                    // Save the file to a directory
                    $targetDir = __DIR__ . '/../public/uploads/';
                    $fileName = time() . '_' . basename($_FILES['media']['name']);
                    $filePath = $targetDir . $fileName;

                    if (move_uploaded_file($_FILES['media']['tmp_name'], $filePath)) {
                        $media->media_url = '/uploads/' . $fileName;
                        $media->save();
                    }
                }

                Application::$app->session->setFlash('success', 'Post created successfully.');
                Application::$app->response->redirect('/');
            }
        }

        return $this->render('create-post');
    }
}
