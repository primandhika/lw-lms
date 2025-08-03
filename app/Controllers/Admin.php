<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\Role;
use App\Models\ClassModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    protected $userModel;
    protected $roleModel;
    protected $classModel;
    
    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->classModel = new ClassModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        if (!$this->isAdminLoggedIn()) {
            return redirect()->to('/syslog');
        }
        
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $this->userModel->countAll(),
            'total_classes' => $this->classModel->countAll(),
            'recent_users' => $this->userModel->orderBy('created_at', 'DESC')->limit(5)->findAll()
        ];
        
        return view('admin/dashboard', $data);
    }
    
    public function login()
    {
        if ($this->isAdminLoggedIn()) {
            return redirect()->to('/dashboard');
        }
        
        $data = ['title' => 'Administrator Login'];
        
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            $user = $this->userModel->getUserByUsername($username);
            
            if ($user && $user['role_name'] === 'administrator' && password_verify($password, $user['password'])) {
                session()->set([
                    'admin_id' => $user['id'],
                    'admin_username' => $user['username'],
                    'admin_logged_in' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
                $data['error'] = 'Invalid credentials or insufficient privileges';
            }
        }
        
        return view('admin/login', $data);
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/syslog');
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
    
    // User Management
    public function users()
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $pager = \Config\Services::pager();
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        
        $users = $this->userModel->select('users.*, roles.name as role_name')
                                 ->join('roles', 'roles.id = users.role_id')
                                 ->paginate($perPage, 'default', $page);
        
        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $users,
            'pager' => $this->userModel->pager
        ];
        
        return view('admin/users/index', $data);
    }
    
    public function createUser()
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $data = [
            'title' => 'Tambah Pengguna',
            'roles' => $this->roleModel->where('name !=', 'administrator')->findAll()
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $userData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'full_name' => $this->request->getPost('full_name'),
                'role_id' => $this->request->getPost('role_id'),
                'bio' => $this->request->getPost('bio'),
                'nomor_kontak' => $this->request->getPost('nomor_kontak'),
                'is_active' => 1
            ];
            
            // Manual validation for create
            $validation = \Config\Services::validation();
            
            $rules = [
                'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'full_name' => 'required|min_length[2]|max_length[255]',
                'role_id' => 'required|integer',
                'bio' => 'permit_empty|max_length[1000]',
                'nomor_kontak' => 'permit_empty|max_length[20]'
            ];
            
            $validation->setRules($rules);
            
            if ($validation->run($userData)) {
                if ($this->userModel->save($userData)) {
                    $data['success'] = 'Pengguna berhasil ditambahkan!';
                    $data['show_back_button'] = true;
                    // Clear form data after success
                    $data['old'] = [];
                } else {
                    $data['errors'] = ['Database error: ' . implode(', ', $this->userModel->errors())];
                    $data['old'] = $userData;
                }
            } else {
                $data['errors'] = $validation->getErrors();
                $data['old'] = $userData;
            }
        }
        
        return view('admin/users/create', $data);
    }
    
    public function editUser($id)
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/dashboard/users')->with('error', 'Pengguna tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Pengguna',
            'user' => $user,
            'roles' => $this->roleModel->where('name !=', 'administrator')->findAll()
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $userData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'full_name' => $this->request->getPost('full_name'),
                'role_id' => $this->request->getPost('role_id'),
                'bio' => $this->request->getPost('bio'),
                'nomor_kontak' => $this->request->getPost('nomor_kontak'),
                'is_active' => $this->request->getPost('is_active') ? 1 : 0
            ];
            
            // Only update password if provided
            $newPassword = $this->request->getPost('password');
            if (!empty($newPassword)) {
                $userData['password'] = $newPassword;
            }
            
            // Manual validation for update with proper unique rules
            $validation = \Config\Services::validation();
            
            $rules = [
                'username' => "required|min_length[3]|max_length[100]|is_unique[users.username,id,$id]",
                'email' => "required|valid_email|is_unique[users.email,id,$id]",
                'full_name' => 'required|min_length[2]|max_length[255]',
                'role_id' => 'required|integer',
                'bio' => 'permit_empty|max_length[1000]',
                'nomor_kontak' => 'permit_empty|max_length[20]'
            ];
            
            // Add password validation only if password is provided
            if (!empty($newPassword)) {
                $rules['password'] = 'min_length[6]';
            }
            
            $validation->setRules($rules);
            
            if ($validation->run($userData)) {
                if ($this->userModel->update($id, $userData)) {
                    $data['success'] = 'Pengguna berhasil diperbarui!';
                    $data['show_back_button'] = true;
                    // Refresh user data after update
                    $data['user'] = $this->userModel->find($id);
                } else {
                    $data['errors'] = ['Database error: ' . implode(', ', $this->userModel->errors())];
                }
            } else {
                $data['errors'] = $validation->getErrors();
            }
        }
        
        return view('admin/users/edit', $data);
    }
    
    public function deleteUser($id)
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/dashboard/users')->with('error', 'Pengguna tidak ditemukan');
        }
        
        // Prevent deleting administrators
        $userWithRole = $this->userModel->getUserWithRole($id);
        if ($userWithRole['role_name'] === 'administrator') {
            return redirect()->to('/dashboard/users')->with('error', 'Tidak dapat menghapus pengguna administrator');
        }
        
        if ($this->userModel->delete($id)) {
            return redirect()->to('/dashboard/users')->with('success', 'Pengguna berhasil dihapus');
        } else {
            return redirect()->to('/dashboard/users')->with('error', 'Gagal menghapus pengguna');
        }
    }
}
