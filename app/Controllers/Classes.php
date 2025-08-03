<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClassModel;
use CodeIgniter\HTTP\ResponseInterface;

class Classes extends BaseController
{
    protected $classModel;
    
    public function __construct()
    {
        $this->classModel = new ClassModel();
        helper(['form', 'url']);
    }
    
    private function isAdminLoggedIn()
    {
        return session()->get('admin_logged_in') === true;
    }
    
    private function requireAdminAuth()
    {
        if (!$this->isAdminLoggedIn()) {
            return redirect()->to('/syslog');
        }
        return null;
    }
    
    public function index()
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $pager = \Config\Services::pager();
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        
        $classes = $this->classModel->orderBy('created_at', 'DESC')
                                   ->paginate($perPage, 'default', $page);
        
        $data = [
            'title' => 'Manajemen Kelas',
            'classes' => $classes,
            'pager' => $this->classModel->pager
        ];
        
        return view('admin/classes/index', $data);
    }
    
    public function create()
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $data = [
            'title' => 'Tambah Kelas'
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $classData = [
                'class_name' => $this->request->getPost('class_name'),
                'description' => $this->request->getPost('description'),
                'year' => $this->request->getPost('year'),
                'teacher_id' => session()->get('admin_id'),
                'is_active' => 1,
                'class_code' => strtoupper(substr(md5(uniqid()), 0, 8))
            ];
            
            try {
                if ($this->classModel->save($classData)) {
                    $data['success'] = 'Kelas berhasil ditambahkan!';
                    $data['show_back_button'] = true;
                    $data['old'] = [];
                } else {
                    $data['errors'] = $this->classModel->errors();
                    $data['old'] = $classData;
                }
            } catch (\Exception $e) {
                $data['errors'] = ['Error: ' . $e->getMessage()];
                $data['old'] = $classData;
            }
        }
        
        return view('admin/classes/create', $data);
    }
    
    public function edit($id)
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $class = $this->classModel->find($id);
        if (!$class) {
            return redirect()->to('/dashboard/classes')->with('error', 'Kelas tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Kelas',
            'class' => $class
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $classData = [
                'class_name' => $this->request->getPost('class_name'),
                'description' => $this->request->getPost('description'),
                'year' => $this->request->getPost('year'),
                'is_active' => $this->request->getPost('is_active') ? 1 : 0
            ];
            
            if ($this->classModel->update($id, $classData)) {
                $data['success'] = 'Kelas berhasil diperbarui!';
                $data['show_back_button'] = true;
                $data['class'] = $this->classModel->find($id);
            } else {
                $data['errors'] = $this->classModel->errors();
            }
        }
        
        return view('admin/classes/edit', $data);
    }
    
    public function delete($id)
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $class = $this->classModel->find($id);
        if (!$class) {
            return redirect()->to('/dashboard/classes')->with('error', 'Kelas tidak ditemukan');
        }
        
        if ($this->classModel->delete($id)) {
            return redirect()->to('/dashboard/classes')->with('success', 'Kelas berhasil dihapus');
        } else {
            return redirect()->to('/dashboard/classes')->with('error', 'Gagal menghapus kelas');
        }
    }
    
    public function join($classCode)
    {
        $class = $this->classModel->where('class_code', $classCode)->first();
        
        if (!$class || !$class['is_active']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $userModel = new \App\Models\User();
        $roleModel = new \App\Models\Role();
        $institutionModel = new \App\Models\Institution();
        
        // Cek apakah user sudah login
        $userId = session()->get('user_id');
        $isLoggedIn = !empty($userId);
        $user = null;
        
        if ($isLoggedIn) {
            $user = $userModel->find($userId);
        }
        
        $data = [
            'title' => 'Bergabung ke Kelas',
            'class' => $class,
            'isLoggedIn' => $isLoggedIn,
            'user' => $user,
            'institutions' => $institutionModel->where('is_active', 1)->findAll()
        ];
        
        // Handle form registration
        if ($this->request->getMethod() === 'POST' && !$isLoggedIn) {
            $studentRoleId = $roleModel->where('name', 'student')->first()['id'];
            
            $username = $this->request->getPost('username');
            $institutionId = $this->request->getPost('institution_id');
            
            // Cek duplikasi NIM + institusi
            $existingUser = $userModel->where('username', $username)
                                     ->where('institution_id', $institutionId)
                                     ->first();
            
            if ($existingUser) {
                $institution = $institutionModel->find($institutionId);
                $data['duplicate_error'] = [
                    'nim' => $username,
                    'institution' => $institution['name']
                ];
                return view('class/join', $data);
            }
            
            // Generate password
            $generatedPassword = $this->generatePassword();
            
            $userData = [
                'username' => $username,
                'email' => $this->request->getPost('email'),
                'password' => password_hash($generatedPassword, PASSWORD_DEFAULT),
                'full_name' => $this->request->getPost('full_name'),
                'bio' => $this->request->getPost('bio'),
                'nomor_kontak' => $this->request->getPost('nomor_kontak'),
                'institution_id' => $institutionId,
                'role_id' => $studentRoleId,
                'is_active' => 1
            ];
            
            try {
                if ($userModel->save($userData)) {
                    $newUserId = $userModel->getInsertID();
                    
                    // Set session untuk auto-login
                    session()->set([
                        'user_id' => $newUserId,
                        'username' => $userData['username'],
                        'user_logged_in' => true
                    ]);
                    
                    $data['success'] = true;
                    $data['newUser'] = [
                        'username' => $userData['username'],
                        'password' => $generatedPassword,
                        'full_name' => $userData['full_name']
                    ];
                    $data['isLoggedIn'] = true;
                    
                    // TODO: Join user to class (implementasi nanti)
                    
                } else {
                    $data['errors'] = $userModel->errors();
                    $data['old'] = $userData;
                }
            } catch (\Exception $e) {
                $data['errors'] = ['Error: ' . $e->getMessage()];
                $data['old'] = $userData;
            }
        }
        
        // Handle user yang sudah login - join ke kelas
        if ($isLoggedIn && $this->request->getMethod() === 'POST' && $this->request->getPost('action') === 'join_class') {
            // TODO: Implementasi join user ke kelas (buat table class_users nanti)
            // Untuk sekarang langsung redirect ke halaman joined
            return redirect()->to("/{$classCode}/joined");
        }
        
        // Handle setelah register berhasil - tidak auto redirect
        // User harus manual klik tombol untuk lanjut ke halaman joined
        
        return view('class/join', $data);
    }
    
    public function joined($classCode)
    {
        $class = $this->classModel->where('class_code', $classCode)->first();
        
        if (!$class || !$class['is_active']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        // Cek apakah user sudah login
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to("/{$classCode}");
        }
        
        $userModel = new \App\Models\User();
        $user = $userModel->find($userId);
        
        if (!$user) {
            return redirect()->to("/{$classCode}");
        }
        
        $data = [
            'title' => 'Berhasil Bergabung',
            'class' => $class,
            'user' => $user
        ];
        
        return view('class/joined', $data);
    }
    
    private function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($chars), 0, $length);
    }
}
