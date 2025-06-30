<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\MaintenanceRequestModel;
use App\Models\LeaseModel;

class MaintenanceController extends BaseController
{
    public function index()
    {
        $tenantId = session()->get('user_id');
        $model = new MaintenanceRequestModel();
        $requests = $model->where('tenant_id', $tenantId)->findAll();

        return view('tenant/maintenance/index', ['requests' => $requests]);
    }

    public function view($id)
    {
        $model = new \App\Models\MaintenanceRequestModel();
        $request = $model->find($id);

        // Optional: Validate ownership
        if (!$request || $request['tenant_id'] != session()->get('user_id')) {
            return redirect()->to('/tenant/maintenance')->with('error', 'Unauthorized or not found.');
        }

        return view('tenant/maintenance/view', ['request' => $request]);
    }

    public function create()
    {
        return view('tenant/maintenance/create');
    }

    public function store()
    {
        $rules = [
            'issue_type' => 'required',
            'description' => 'required'
        ];

        if (!$this->validate($rules)) {
            return view('tenant/maintenance/create', [
                'validation' => $this->validator
            ]);
        }

        // Get tenant's active lease to find associated property
        $tenantId = session()->get('user_id');
        $leaseModel = new LeaseModel();
        $lease = $leaseModel->where('tenant_id', $tenantId)->first();

        if (!$lease) {
            return redirect()->back()->with('error', 'No active lease found for this tenant.');
        }

        // File handling
        $imageFile = $this->request->getFile('image');
        $imageName = null;

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move('uploads/maintenance/', $imageName);
        }

        $model = new MaintenanceRequestModel();
        $model->save([
            'tenant_id' => session()->get('user_id'),
            'property_id' => $lease['property_id'],
            'issue_type' => $this->request->getPost('issue_type'),
            'description' => $this->request->getPost('description'),
            'status' => 'submitted',
            'submitted_at' => date('Y-m-d H:i:s'),
            'image' => $imageName
        ]);

        return redirect()->to('/tenant/maintenance')->with('success', 'Request submitted');
    }

    public function feedback($id)
    {
        $model = new MaintenanceRequestModel();
        $request = $model->find($id);

        // 💡 Check tenant ownership and status
        if (
            !$request ||
            $request['tenant_id'] != session()->get('user_id') ||
            $request['status'] !== 'resolved'
        ) {
            return redirect()->to('/tenant/maintenance')->with('error', 'Unauthorized or invalid request.');
        }

        return view('tenant/maintenance/feedback', ['request' => $request]);
    }

    public function submitFeedback($id)
    {
        $feedback = trim($this->request->getPost('feedback'));

        if (empty($feedback)) {
            return redirect()->back()->withInput()->with('error', 'Feedback cannot be empty.');
        }

        $model = new \App\Models\MaintenanceRequestModel();
        $request = $model->find($id);

        if (
            !$request ||
            $request['tenant_id'] != session()->get('user_id') ||
            $request['status'] !== 'resolved'
        ) {
            return redirect()->to('/tenant/maintenance')->with('error', 'Unauthorized or invalid request.');
        }

        // ✅ Only attempt update if feedback is non-empty
        $model->update($id, ['feedback' => $feedback]);

        return redirect()->to('/tenant/maintenance')->with('success', 'Thank you for your feedback!');
    }
}
