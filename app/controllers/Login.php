<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Login extends Controller {
    public function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->call->model('Mod_Student');
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Check credentials from DB
            $data = $this->Mod_Student->profile($email, $password);

            if ($data) {
                // ✅ Set session
                $_SESSION['user_id']  = $data['id'];
                $_SESSION['first_name']    = $data['first_name'];
                $_SESSION['last_name']    = $data['last_name'];
                $_SESSION['email']    = $data['email'];
                $_SESSION['password']    = $data['password'];
                $_SESSION['role']      = $data['role'];
                $_SESSION['logged_in'] = true;

                // ✅ Redirect based on role
                if ($data['role'] === 'admin') {
                    header("Location: /student/index/1"); // Admin page
                    exit;
                } elseif ($data['role'] === 'user') {
                    $this->call->view('ProfPage', ['data' => $data]); // User profile page
                    return;
                } else {
                    // Unknown role fallback
                    session_destroy();
                    $data['error'] = 'Access denied. Invalid role.';
                    $this->call->view('logPage', $data);
                    return;
                }
            } else {
                // ❌ Invalid credentials
                $data['error'] = 'Invalid email or password';
                $this->call->view('logPage', $data);
                return;
            }
        } else {
            $this->call->view('logPage');
        }
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $passwo = !empty($_POST['passw']) ? $_POST['passw'] : $_POST['Last_Name'];

            $users = [
                'first_name' => $_POST['First_Name'],
                'last_name' => $_POST['Last_Name'],
                'email' => $_POST['Email'],
                'password' => $passwo,
                // default signup role is user
                'role'  => 'user'
            ];
            $this->Mod_Student->insert($users);

            header("Location: /login");
            exit;
        }
        $this->call->view('signPage');
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        header("Location: /login");
        exit;
    }
}
