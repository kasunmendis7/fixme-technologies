<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
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
        $reqId = $request->getBody()['req_id'] ?? null;
        $status = $request->getBody()['status'] ?? null;
        if ($reqId && $status && in_array($status, ['InProgress', 'Rejected'])) {
            $updated = TechnicianRequest::updateStatus($reqId, $status);
            if ($updated) {
                $_SESSION['success'] = "Request updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update request.";
            }
        } else {
            $_SESSION['error'] = "Invalid request.";
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

    /**
     * Get all bank accounts for the logged-in technician
     */
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

    /**
     * Delete a specific bank account
     *
     * @param array $id Bank account ID
     */
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
}

