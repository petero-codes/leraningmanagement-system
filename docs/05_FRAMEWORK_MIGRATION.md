# FRAMEWORK MIGRATION GUIDE

## Laravel Implementation

### Overview
Laravel is a modern PHP framework that provides built-in authentication, ORM, routing, and many other features that can simplify the SAMS implementation.

### Key Advantages
- **Eloquent ORM:** Object-relational mapping for database operations
- **Built-in Authentication:** Laravel Breeze/Jetstream for user management
- **Blade Templating:** Powerful templating engine
- **Artisan CLI:** Command-line tools for code generation
- **Validation:** Built-in form validation
- **Security:** CSRF protection, password hashing, SQL injection prevention

### Migration Steps

#### 1. Install Laravel
```bash
composer create-project laravel/laravel sams-laravel
cd sams-laravel
```

#### 2. Database Configuration
Edit `.env` file:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sams_db
DB_USERNAME=root
DB_PASSWORD=
```

#### 3. Create Models
```bash
php artisan make:model Student
php artisan make:model Course
php artisan make:model Enrollment
php artisan make:model User
```

#### 4. Create Migrations
```bash
php artisan make:migration create_students_table
php artisan make:migration create_courses_table
php artisan make:migration create_enrollments_table
```

#### 5. Create Controllers
```bash
php artisan make:controller StudentController --resource
php artisan make:controller CourseController --resource
php artisan make:controller EnrollmentController --resource
php artisan make:controller ReportController
```

#### 6. Example Student Model (app/Models/Student.php)
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id', 'first_name', 'last_name', 
        'email', 'phone', 'address', 'date_of_birth',
        'enrollment_date', 'status'
    ];
    
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
```

#### 7. Example Controller (app/Http/Controllers/StudentController.php)
```php
<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students',
            'enrollment_date' => 'required|date',
        ]);
        
        Student::create($validated);
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }
}
```

#### 8. Routes (routes/web.php)
```php
Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::get('/reports', [ReportController::class, 'index']);
});
```

### Key Differences from Pure PHP
- **Database:** Eloquent ORM instead of PDO
- **Templates:** Blade instead of PHP includes
- **Validation:** Laravel validation instead of custom functions
- **Authentication:** Laravel Breeze instead of custom sessions
- **Routing:** Route files instead of direct file access

---

## CodeIgniter Implementation

### Overview
CodeIgniter is a lightweight PHP framework that provides MVC architecture and useful libraries while maintaining simplicity.

### Key Advantages
- **Lightweight:** Minimal overhead
- **MVC Architecture:** Clear separation of concerns
- **Active Record:** Database query builder
- **Form Validation:** Built-in validation library
- **Session Management:** Secure session handling
- **URL Routing:** Clean URLs

### Migration Steps

#### 1. Download CodeIgniter
Download from https://codeigniter.com and extract to web server directory.

#### 2. Database Configuration
Edit `application/config/database.php`:
```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'sams_db',
    'dbdriver' => 'postgre',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

#### 3. Create Model (application/models/Student_model.php)
```php
<?php
class Student_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all() {
        return $this->db->get('students')->result_array();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where('students', array('id' => $id))->row_array();
    }
    
    public function create($data) {
        $this->db->insert('students', $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('students', $data);
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('students');
    }
}
```

#### 4. Create Controller (application/controllers/Students.php)
```php
<?php
class Students extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('student_model');
        $this->load->library('form_validation');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }
    
    public function index() {
        $data['students'] = $this->student_model->get_all();
        $this->load->view('students/index', $data);
    }
    
    public function create() {
        $this->form_validation->set_rules('student_id', 'Student ID', 'required|is_unique[students.student_id]');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[students.email]');
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('students/create');
        } else {
            $data = array(
                'student_id' => $this->input->post('student_id'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'enrollment_date' => $this->input->post('enrollment_date'),
                'status' => $this->input->post('status')
            );
            
            $this->student_model->create($data);
            $this->session->set_flashdata('success', 'Student created successfully.');
            redirect('students');
        }
    }
}
```

#### 5. Routes (application/config/routes.php)
```php
$route['students'] = 'students/index';
$route['students/create'] = 'students/create';
$route['students/edit/(:num)'] = 'students/edit/$1';
$route['students/delete/(:num)'] = 'students/delete/$1';
```

### Key Differences from Pure PHP
- **Database:** CodeIgniter Database class instead of PDO
- **Sessions:** CodeIgniter Session library
- **Validation:** CodeIgniter Form Validation library
- **URLs:** Clean URLs with routing
- **Structure:** MVC pattern enforced

---

## Comparison Table

| Feature | Pure PHP | Laravel | CodeIgniter |
|---------|----------|---------|-------------|
| Learning Curve | Easy | Moderate | Easy |
| Performance | Fast | Moderate | Fast |
| Security Features | Manual | Built-in | Built-in |
| Database ORM | PDO | Eloquent | Active Record |
| Authentication | Custom | Built-in | Manual |
| Validation | Custom | Built-in | Built-in |
| Templating | PHP includes | Blade | PHP views |
| Routing | File-based | Route files | Route config |
| Community | Large | Very Large | Large |
| Documentation | Good | Excellent | Good |

---

## Recommendation

**For Academic Projects:**
- **Pure PHP:** Best for learning fundamentals, full control
- **Laravel:** Best for modern development, industry standard
- **CodeIgniter:** Best for lightweight, simple projects

**For Production:**
- **Laravel:** Recommended for scalability and features
- **CodeIgniter:** Good for simple, fast deployments
- **Pure PHP:** Requires more security considerations

---

*End of Framework Migration Guide*

