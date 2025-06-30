<?php

namespace App\Controllers\Landlord;

use App\Controllers\BaseController;
use App\Models\LeaseModel;
use App\Models\UserModel;
use App\Models\PropertyModel;

class LeaseController extends BaseController
{
    public function index()
    {
        $model = new LeaseModel();
        $leases = $model->findAll();
        return view('landlord/leases/index', ['leases' => $leases]);
    }

    public function create()
    {
        $userModel = new UserModel();
        $propertyModel = new PropertyModel();

        $tenants = $userModel->where('role', 'tenant')->findAll();
        $properties = $propertyModel->where('landlord_id', session()->get('user_id'))->findAll();

        return view('landlord/leases/create', [
            'tenants' => $tenants,
            'properties' => $properties
        ]);
    }

    public function store()
    {
        $rules = [
            'tenant_id'    => 'required|integer',
            'property_id'  => 'required|integer',
            'start_date'   => 'required|valid_date',
            'end_date'     => 'required|valid_date',
            'monthly_rent' => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('validation', $this->validator);
        }

        $fileName = null;
        $file = $this->request->getFile('agreement_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/leases/', $fileName);
        }

        $model = new LeaseModel();
        $rent = preg_replace('/[^0-9.]/', '', $this->request->getPost('monthly_rent'));
        $model->save([
            'tenant_id'      => $this->request->getPost('tenant_id'),
            'property_id'    => $this->request->getPost('property_id'),
            'start_date'     => $this->request->getPost('start_date'),
            'end_date'       => $this->request->getPost('end_date'),
            'monthly_rent'   => $rent,
            'agreement_file' => $fileName,
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/landlord/leases')->with('success', 'Lease created successfully.');
    }

    public function edit($id)
    {
        $model = new LeaseModel();
        $lease = $model->find($id);

        if (!$lease) {
            return redirect()->to('/landlord/leases')->with('error', 'Lease not found.');
        }

        $userModel = new UserModel();
        $propertyModel = new PropertyModel();

        $tenants = $userModel->where('role', 'tenant')->findAll();
        $properties = $propertyModel->where('landlord_id', session()->get('user_id'))->findAll();

        return view('landlord/leases/edit', [
            'lease' => $lease,
            'tenants' => $tenants,
            'properties' => $properties
        ]);
    }

    public function update($id)
    {
        $rules = [
            'tenant_id' => 'required',
            'property_id' => 'required',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
            'monthly_rent' => 'required|decimal',
            'agreement_file' => 'permit_empty|mime_in[agreement_file,application/pdf]|max_size[agreement_file,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $model = new LeaseModel();
        $lease = $model->find($id);

        if (!$lease) {
            return redirect()->to('/landlord/leases')->with('error', 'Lease not found.');
        }

        $fileName = $lease['agreement_file']; // default to old file
        $file = $this->request->getFile('agreement_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // ✅ Delete old file if it exists
            if (!empty($lease['agreement_file'])) {
                $oldFilePath = FCPATH . 'uploads/leases/' . $lease['agreement_file'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // ✅ Upload new file
            $fileName = $file->getRandomName();
            $file->move('uploads/leases/', $fileName);
        }

        $model->update($id, [
            'tenant_id' => $this->request->getPost('tenant_id'),
            'property_id' => $this->request->getPost('property_id'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'monthly_rent' => preg_replace('/[^0-9.]/', '', $this->request->getPost('monthly_rent')),
            'agreement_file' => $fileName,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/landlord/leases')->with('success', 'Lease updated successfully.');
    }

}