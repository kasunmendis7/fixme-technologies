<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Customer;
use app\models\Post;
use app\models\ServiceCenterReview;
use app\models\Technician;
use app\models\TechnicianRequest;
use app\models\Chat;
use app\models\TechnicianPaymentMethod;

class TechnicianController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function technicianLanding()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-landing');
    }

    public function technicianHome()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-home');
    }

    public function technicianDashboard()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-dashboard');
    }

    public function technicianMap()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-map');
    }

    public function technicianMessages()
    {
        $tech_id = Application::$app->session->get('technician');
        $model = new Chat();

        // Get customer chat list
        $customers = $model->getCustomerChatList($tech_id);

        $this->setLayout('auth');
        return $this->render('/technician/technician-messages', [
            'customers' => $customers
        ]);
    }

    public function technicianSettings()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-settings');
    }

    public function technicianHelp()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-help');
    }

    public function technicianProfile()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-profile');
    }

    public function updateTechnicianProfile(Request $request)
    {
        $technician = new Technician();

        if ($request->isPost()) {
            $technician->loadData($request->getBody());

            if (!empty($_FILES['profile_picture']['name'])) {
                $file = $_FILES['profile_picture'];
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];
                $fileType = $file['type'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxSize = 2 * 1024 * 1024; // max file size 2MB

                if (!in_array($fileType, $allowedTypes)) {
                    throw new \Exception('Unsupported file type. Please upload a JPEG, PNG or JPG file.');
                }
                if ($fileSize > $maxSize) {
                    throw new \Exception('File size exceeds the 2MB limit.');
                }

                $uploadDir = dirname(__DIR__) . '/public/uploads/profile-pictures/technician/';
                $newFileName = uniqid('profile_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destination = $uploadDir . $newFileName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (!move_uploaded_file($fileTmpName, $destination)) {
                    throw new \Exception('Failed to upload the file');
                }

                $technicianId = Application::$app->session->get('technician');
                $relativePath = '/uploads/profile-pictures/technician/' . $newFileName;
                $sql = 'UPDATE technician SET profile_picture = :profile_picture WHERE tech_id = :tech_id';
                $stmt = Application::$app->db->prepare($sql);
                $stmt->bindValue(':profile_picture', $relativePath);
                $stmt->bindValue(':tech_id', $technicianId);
                $stmt->execute();
            }

            if ($technician->updateValidate()) {
                $technician->updateTechnician();
                Application::$app->session->setFlash('update-success', 'You have been Updated your account info successfully!');
                Application::$app->response->redirect('/technician-profile');
            } else {
                Application::$app->response->redirect('/technician-profile');
            }
        }
    }

    public function technicianCreatePost()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-create-post');
    }

    public function technicianEditPost(Request $request)
    {
        $this->setLayout('auth');

        // Retrieve the post_id from the request (assuming it's passed as a query parameter)
        $post_id = $request->getBody()['post_id'] ?? null;
        if (!$post_id) {
            return $this->render('/technician/technician-community', ['error' => 'Post not found']);
        }

        // Load post data from the database
        $post = (new Post)->findOne(['post_id' => $post_id]);

        if (!$post) {
            return $this->render('/technician/technician-community', ['error' => 'Post not found']);
        }

        // Pass the post data to the view
        return $this->render('/technician/technician-edit-post', ['post' => $post]);
    }

    public function viewTechnicianProfile($id)
    {
        // echo json_encode($id);
        // $id is an array, we need only the first element of that array
        $technician = (new Technician())->findById(intval($id[0]));
        $this->setLayout('auth');
        if (!$technician) {
            return $this->render('_404');
        }
        // show($technician['fname']);
        $postModel = new Post();
        $posts = $postModel->getPostsByTechnicianId(intval($id[0]));

        $reviewModel = new ServiceCenterReview();

        return $this->render('/customer/technician-profile', [
            'technician' => $technician,
            'posts' => $posts
        ]);
    }

    public function viewRequests()
    {
        $technicianId = Application::$app->session->get('technician') ?? null;
        if (!$technicianId) {
            Application::$app->response->redirect('/technician-login');
        }
        $requests = TechnicianRequest::getRequestsByTechnicianId($technicianId);
        $this->setLayout('auth');
        return $this->render('/technician/technician-requests', ['requests' => $requests]);
    }

    public function updateRequestStatus($request)
    {
        $body = $request->getBody();

        $cus_id = $body['cus_id'];
        $req_id = $body['req_id'];
        $status = $body['status'];
        $advance_payment = $body['advance_payment'];
        $tech_id = Application::$app->session->get('technician');

        if ($req_id && $status && in_array($status, ['InProgress', 'Rejected'])) {
            $updated = TechnicianRequest::updateStatus($req_id, $status);
            if ($updated) {
                $_SESSION['success'] = "Request updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update request.";
            }
        } else {
            $_SESSION['error'] = "Invalid request.";
        }

        // Validate advance_payment
        if (empty($advance_payment) || !is_numeric($advance_payment)) {
            Application::$app->session->setFlash('Accept-before-view-error', "Please view the request first");
            Application::$app->response->redirect('/technician-requests');
            return;
        }

        if ($status === 'InProgress') {
            $sql = 'INSERT INTO cus_tech_adv_payment (cus_id, tech_id, amount, req_id) VALUES (:cus_id, :tech_id, :amount, :req_id)';
            $stmt = Application::$app->db->prepare($sql);
            $stmt->bindValue(':cus_id', $cus_id);
            $stmt->bindValue(':tech_id', $tech_id);
            $stmt->bindValue(':amount', $advance_payment);
            $stmt->bindValue(':req_id', $req_id);
            $stmt->execute();
        }

        Application::$app->response->redirect('/technician-requests');
    }

    public function technicianTransactions()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-transactions');
    }

    public function technicianPaymentDetails()
    {
        $this->setLayout('auth');
        return $this->render('/technician/technician-payment-details');
    }

    public function viewCustomerRequest($id)
    {
        $customer = (new Customer())->findById(intval($id[0]));
        Application::$app->session->set('customer-destination', $id[0]);

        $this->setLayout('auth');
        return $this->render('/technician/customer-request', [
            'customer' => $customer
        ]);
    }

    public function technicianPaymentMethod()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $bankAccNum = $request['bank_acc_num'] ?? null;
        $bankAccName = $request['bank_acc_name'] ?? null;
        $bankAccBranch = $request['bank_acc_branch'] ?? null;

        if (!$bankAccNum || !$bankAccName) {
            echo json_encode(['success' => false, 'message' => 'Bank account number and name are required.']);
            exit;
        }

        $lastFour = substr($bankAccNum, -4);

        $paymentMethod = new TechnicianPaymentMethod();
        $techId = Application::$app->session->get('technician');

        try {
            $paymentMethod->addPaymentMethod(
                $techId,
                $lastFour,
                $bankAccNum,
                $bankAccName,
                $bankAccBranch
            );

            // Respond to frontend
            echo json_encode([
                'success' => true,
                'message' => 'Bank account added successfully.',
                'data' => [
                    'bank_acc_name' => $bankAccName,
                    'last_four' => $lastFour,
                    'bank_acc_branch' => $bankAccBranch,
                ],
            ]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }


    public function getTechnicianPaymentMethods()
    {
        try {
            $techId = Application::$app->session->get('technician');
            if (!$techId) {
                throw new \Exception('Technician not logged in');
            }

            $paymentMethodModel = new TechnicianPaymentMethod();
            $paymentMethods = $paymentMethodModel->getPaymentMethods($techId);
            echo json_encode(['success' => true, 'data' => $paymentMethods]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    public function deleteTechnicianPaymentMethod($id)
    {
        try {
            $techId = Application::$app->session->get('technician');
            $id = intval($id[0]);

            if (!$techId) {
                throw new \Exception('Technician not logged in');
            }

            $paymentMethodModel = new TechnicianPaymentMethod();
            $paymentMethodModel->deletePaymentMethod($id, $techId);

            echo json_encode(['success' => true, 'message' => 'Bank account deleted successfully']);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getOriginDestination()
    {
        $tech_id = Application::$app->session->get('technician');
        $cus_id = Application::$app->session->get('customer-destination');

        $cus_loc = json_decode((new Customer())->getCustomerLocationUsingId($cus_id));
        $tech_loc = json_decode((new Technician())->getTechnicianLocationUsingId($tech_id));

        return json_encode(['customer_location' => $cus_loc, 'technician_location' => $tech_loc]);
    }

    public function getRoute(Request $request)
    {
        $body = json_decode(file_get_contents('php://input'), true);

        if (!isset($body['origin'], $body['destination'], $body['mode'])) {
            throw new \Exception("Missing required parameters: origin, destination, or mode.");
        }


        $origin = $body['origin'];       // Format: "latitude,longitude"
        $destination = $body['destination']; // Format: "latitude,longitude"
        $travelMode = strtoupper($body['mode']);     // Example: DRIVING, WALKING, TRANSIT, BICYCLING

        $API_KEY = $_ENV['API_KEY']; // Replace with your actual API key

        $url = "https://routes.googleapis.com/directions/v2:computeRoutes";

        // Build the request JSON for Google's Routes API
        $routeRequest = [
            'origin' => [
                'location' => [
                    'latLng' => [
                        'latitude' => floatval(explode(',', $origin)[0]),
                        'longitude' => floatval(explode(',', $origin)[1])
                    ]
                ]
            ],
            'destination' => [
                'location' => [
                    'latLng' => [
                        'latitude' => floatval(explode(',', $destination)[0]),
                        'longitude' => floatval(explode(',', $destination)[1])
                    ]
                ]
            ],
            'travelMode' => $travelMode, // Can be WALKING, DRIVING, etc.
            'routingPreference' => 'TRAFFIC_AWARE',
            'computeAlternativeRoutes' => false,
            'units' => 'IMPERIAL',
            'languageCode' => 'en-US',
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Goog-Api-Key:' . $_ENV['API_KEY'],
            'X-Goog-FieldMask: routes.duration,routes.distanceMeters,routes.polyline.encodedPolyline',

        ]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($routeRequest));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        $response = curl_exec($curl);

        if ($error = curl_error($curl)) {
            curl_close($curl);
            return json_encode(['success' => false, 'error' => $error]);
        }

        curl_close($curl);

        return $response; // JSON response from Routes API

    }

    public function storeAdvancePayment(Request $request)
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $req_id = $body['req_id'];
        $advance_payment = $body['advance_payment'];

        Application::$app->session->set("advance_payment_$req_id", $advance_payment);
        Application::$app->response->setStatusCode(200);
        return json_encode(['success' => true]);
    }

    public function markRequestViewed(Request $request)
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $req_id = $body['req_id'];

        if ($req_id) {
            Application::$app->session->set("viewed_request_$req_id", true);
            Application::$app->response->setStatusCode(200);
            echo json_encode(['success' => true]);
        } else {
            Application::$app->response->setStatusCode(400);
            echo json_encode(['success' => false]);
        }

    }
}

