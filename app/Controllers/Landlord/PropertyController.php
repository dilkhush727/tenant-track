<?php

namespace App\Controllers\Landlord;

use App\Controllers\BaseController;
use App\Models\PropertyModel;

class PropertyController extends BaseController
{
    public function index()
    {
        $landlordId = session()->get('user_id');
        $model = new PropertyModel();
        $properties = $model->where('landlord_id', $landlordId)->findAll();

        return view('landlord/property/index', ['properties' => $properties]);
    }

    public function create()
    {
        return view('landlord/property/create');
    }

    public function store()
    {
        $rules = [
            'address' => 'required',
            'type' => 'required',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('landlord/property/create', ['validation' => $this->validator]);
        }

        $model = new PropertyModel();
        $model->save([
            'landlord_id' => session()->get('user_id'),
            'address' => $this->request->getPost('address'),
            'type' => $this->request->getPost('type'),
            'availability' => 1,
            'description' => $this->request->getPost('description'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/landlord/properties')->with('success', 'Property added.');
    }

    public function edit($id)
    {
        $model = new PropertyModel();
        $property = $model->find($id);
        return view('landlord/property/edit', ['property' => $property]);
    }

    public function update($id)
    {
        $model = new PropertyModel();

        $rules = [
            'address' => 'required',
            'type' => 'required',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('landlord/property/edit', ['property' => $model->find($id), 'validation' => $this->validator]);
        }

        $model->update($id, [
            'address' => $this->request->getPost('address'),
            'type' => $this->request->getPost('type'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/landlord/properties')->with('success', 'Property updated.');
    }

    public function delete($id)
    {
        $model = new PropertyModel();
        $model->delete($id);
        return redirect()->to('/landlord/properties')->with('success', 'Property deleted.');
    }
}