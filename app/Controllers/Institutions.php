<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Institution;
use CodeIgniter\HTTP\ResponseInterface;

class Institutions extends BaseController
{
    protected $institutionModel;
    
    public function __construct()
    {
        $this->institutionModel = new Institution();
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
        
        $institutions = $this->institutionModel->orderBy('created_at', 'DESC')
                                              ->paginate($perPage, 'default', $page);
        
        $data = [
            'title' => 'Manajemen Institusi',
            'institutions' => $institutions,
            'pager' => $this->institutionModel->pager
        ];
        
        return view('admin/institutions/index', $data);
    }
    
    public function create()
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $data = [
            'title' => 'Tambah Institusi'
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $institutionData = [
                'name' => $this->request->getPost('name'),
                'code' => $this->request->getPost('code'),
                'type' => 'universitas', // default value, bisa diubah nanti
                'address' => $this->request->getPost('address'),
                'is_active' => 1
            ];
            
            try {
                if ($this->institutionModel->save($institutionData)) {
                    $data['success'] = 'Institusi berhasil ditambahkan!';
                    $data['show_back_button'] = true;
                    $data['old'] = [];
                } else {
                    $data['errors'] = $this->institutionModel->errors();
                    $data['old'] = $institutionData;
                }
            } catch (\Exception $e) {
                $data['errors'] = ['Error: ' . $e->getMessage()];
                $data['old'] = $institutionData;
            }
        }
        
        return view('admin/institutions/create', $data);
    }
    
    public function edit($id)
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $institution = $this->institutionModel->find($id);
        if (!$institution) {
            return redirect()->to('/dashboard/institutions')->with('error', 'Institusi tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Institusi',
            'institution' => $institution
        ];
        
        if ($this->request->getMethod() === 'POST') {
            $institutionData = [
                'name' => $this->request->getPost('name'),
                'code' => $this->request->getPost('code'),
                'type' => 'universitas', // default value, bisa diubah nanti
                'address' => $this->request->getPost('address'),
                'is_active' => $this->request->getPost('is_active') ? 1 : 0
            ];
            
            if ($this->institutionModel->update($id, $institutionData)) {
                $data['success'] = 'Institusi berhasil diperbarui!';
                $data['show_back_button'] = true;
                $data['institution'] = $this->institutionModel->find($id);
            } else {
                $data['errors'] = $this->institutionModel->errors();
            }
        }
        
        return view('admin/institutions/edit', $data);
    }
    
    public function delete($id)
    {
        $redirect = $this->requireAdminAuth();
        if ($redirect) return $redirect;
        
        $institution = $this->institutionModel->find($id);
        if (!$institution) {
            return redirect()->to('/dashboard/institutions')->with('error', 'Institusi tidak ditemukan');
        }
        
        if ($this->institutionModel->delete($id)) {
            return redirect()->to('/dashboard/institutions')->with('success', 'Institusi berhasil dihapus');
        } else {
            return redirect()->to('/dashboard/institutions')->with('error', 'Gagal menghapus institusi');
        }
    }
}
