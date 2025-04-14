<?php

namespace app\controllers;

use app\core\Controller;
use app\models\TechnicianReview;
use app\core\Request;
use app\core\Response;
use app\models\Technician;

class TechnicianReviewController extends Controller
{
    public function submit(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $review = new TechnicianReview();
            $review->loadData($request->getBody());
            if ($review->saveReview()) {
                echo "Your Technician Review & Rating Successfully Submitted";
            } else {
                echo "Error saving review.";
            }
        }
    }

    public function fetch(Request $request, Response $response)
    {
        if ($request->isPost()) {
            // Get the current URL path to extract tech_id
            $path = $_SERVER['HTTP_REFERER'] ?? '';
            $pathParts = explode('/', $path);
            $tech_id = end($pathParts);

            // Ensure tech_id is numeric
            if (!is_numeric($tech_id)) {
                echo json_encode(['error' => 'Invalid technician ID']);
                return;
            }

            $reviewModel = new TechnicianReview();
            $reviews = $reviewModel->fetchTechnicianReviews($tech_id);

            $stats = [
                'total_review' => count($reviews),
                'five_star_review' => 0,
                'four_star_review' => 0,
                'three_star_review' => 0,
                'two_star_review' => 0,
                'one_star_review' => 0,
                'total_user_rating' => 0,
                'review_data' => [],
            ];

            foreach ($reviews as $row) {
                $rating = $row['user_rating'];
                $stats['review_data'][] = [
                    'user_name' => $row['user_name'],
                    'user_review' => $row['user_review'],
                    'rating' => $rating,
                    'datetime' => date('l jS, F Y h:i:s A', strtotime($row['datetime']))
                ];

                // Update the appropriate star count
                if ($rating >= 1 && $rating <= 5) {
                    $ratings = ['1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five'];
                    $key = "{$ratings[$rating]}_star_review";
                    $stats[$key]++;
                }

                $stats['total_user_rating'] += $rating;
            }

            $stats['average_rating'] = number_format(
                $stats['total_review'] ? ($stats['total_user_rating'] / $stats['total_review']) : 0,
                1
            );

            echo json_encode($stats);
        }
    }
}
