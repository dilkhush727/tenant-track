<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnnouncementModel;

class AnnouncementController extends BaseController
{
    public function index()
    {
        $model = new AnnouncementModel();
        $data['announcements'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('admin/announcements/index', $data);
    }

    public function create()
    {
        return view('admin/announcements/create');
    }

    public function store()
    {
        $rules = [
            'title' => 'required',
            'message' => 'required',
            'target_role' => 'required|in_list[all,tenant,landlord]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $model = new AnnouncementModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'message' => $this->request->getPost('message'),
            'target_role' => $this->request->getPost('target_role'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/announcements')->with('success', 'Announcement posted.');
    }
}
