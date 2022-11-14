<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['title'] = 'Admin';
        $data['users'] = $model->findAdmins();
        return view('admin/admin/index', $data);
    }

    public function tambah()
    {
        helper('form');
        $model = new UserModel();
        $data['title'] = 'Tambah Admin';
        return view('admin/admin/tambah', $data);
    }

    public function edit($user_id)
    {
        $model = new UserModel();
        $data['title'] = 'Edit Admin';
        $data['admin'] = $model->find($user_id);
        return view('admin/admin/edit', $data);
    }

    public function delete($user_id)
    {
        $model = new UserModel();
        $model->delete($user_id);
        return redirect()->to('admin/admin');
    }
    public function store()
    {
        $data = $this->request->getPost();
        $data['user_type'] = 'admin';
        $data['user_active'] = 1;
        $model = new UserModel();
        if ($model->insert($data)) {
            return redirect()->to('admin/admin');
        } else {
            // dd($model->errors()['password_confirmation']);
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }
    }
}
