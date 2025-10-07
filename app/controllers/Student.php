<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Student extends Controller
{
    
    public function __construct()
    {
        parent::__construct();

        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Only allow admin
        if (empty($_SESSION['logged_in']) || ($_SESSION['role'] ?? '') !== 'admin') {
            // Not allowed: redirect to login
            header("Location: /login");
            exit;
        }

        $this->call->model('Mod_Student');
        $this->call->library('pagination');

        // Bootstrap pagination theme
        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'ul'       => 'pagination justify-content-center',
            'li'       => 'page-item',
            'a'        => 'page-link',
            'active'   => 'active',
            'disabled' => 'disabled'
        ]);
    }


    /**
     * Core pagination + search logic
     */
    private function paginate_and_render($page = 1, $sear = '')
    {
        $per_page = 10;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['searchbar']) && $_POST['searchbar'] != '') {
                $sear = $_POST['searchbar'];
            }
            // $result = $this->Mod_Student->raw("SELECT * FROM students WHERE fname LIKE '?%'", [$sear]);
            $total_rows = $this->Mod_Student->count_records($sear);
             $pagination_data = $this->pagination->initialize(
                $total_rows['total'],
                $per_page,
                $page,
                'student/index',
                5
            );

            // ✅ Fetch records (supports search)
            $data['records']          = $this->Mod_Student->get_records($pagination_data['limit'],$sear);
            $data['total_records']    = $total_rows['total'];
            $data['pagination_data']  = $pagination_data;
            $data['pagination_links'] = $this->pagination->paginate();

            $this->call->view('studentPage', $data);
        } else {
            
        
            // ✅ Total rows (supports search)
            $total_rows = $this->Mod_Student->count_records();

            // ✅ Setup pagination
            $pagination_data = $this->pagination->initialize(
                $total_rows['total'],
                $per_page,
                $page,
                'student/index',
                5
            );

            // ✅ Fetch records (supports search)
            $data['records']          = $this->Mod_Student->get_records($pagination_data['limit']);
            $data['total_records']    = $total_rows['total'];
            $data['pagination_data']  = $pagination_data;
            $data['pagination_links'] = $this->pagination->paginate();

            $this->call->view('studentPage', $data);
        }
            
    }

    /**
     * List students
     */
    public function index($page = 1)
    {
            $this->paginate_and_render($page);
    }

    /**
     * Add new student
     */
    public function addd($page = 1)
    {
            if (isset($_POST['passw']) && $_POST['passw'] != '') {
                $passwo = $_POST['passw'];
                
            }else{
                $passwo = $_POST['Last_Name'];
            }
            $users = [
                    'fname' => $_POST['First_Name'],
                    'lname' => $_POST['Last_Name'],
                    'email' => $_POST['Email'],
                    'passw' => $passwo,
                    'role'  => $_POST['role']  
                ];
                $this->Mod_Student->insert($users);

            $this->paginate_and_render($page);
    }

    /**
     * Update student
     */
    public function updt($page = 1)
    {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $users = [
                    'fname' => $_POST['First_Name'],
                    'lname' => $_POST['Last_Name'],
                    'email' => $_POST['Email']
                ];
                $this->Mod_Student->update($_POST['id'], $users);
            }
            $this->paginate_and_render($page);
    }

    /**
     * Delete student
     */
    public function delete($page = 1)
    {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
                $this->Mod_Student->delete($_POST['id']);
            }
            $this->paginate_and_render($page);
        
    }
}
