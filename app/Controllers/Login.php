<?php

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        // Redirect jika sudah login
        if (session()->get('user_logged_in')) {
            return redirect()->to('/');
        }
        
        $data = ['title' => 'Login'];
        
        if ($this->request->getMethod() === 'POST') {
            $userModel = new User();
            
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            $user = $userModel->getUserByUsername($username);
            
            if ($user && password_verify($password, $user['password']) && $user['is_active']) {
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'user_logged_in' => true
                ]);
                
                // Redirect ke halaman yang diminta sebelumnya atau home
                $redirectTo = session()->get('redirect_to') ?? '/';
                session()->remove('redirect_to');
                
                return redirect()->to($redirectTo);
            } else {
                $data['error'] = 'Username atau password salah';
            }
        }
        
        return view('login', $data);
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
