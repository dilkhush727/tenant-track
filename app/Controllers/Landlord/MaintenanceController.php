<?php

namespace App\Controllers\Landlord;

use App\Controllers\BaseController;
use App\Models\MaintenanceRequestModel;
use App\Models\UserModel;
use App\Models\PropertyModel;

class MaintenanceController extends BaseController
{
    public function index()
    {
        $landlordId = session()->get('user_id');

        $model = new MaintenanceRequestModel();
        $requests = $model->select('maintenance_requests.*, users.name AS tenant_name, properties.address AS property_address')
            ->join('users', 'users.id = maintenance_requests.tenant_id')
            ->join('properties', 'properties.id = maintenance_requests.property_id')
            ->where('properties.landlord_id', $landlordId)
            ->findAll();

        return view('landlord/maintenance/index', ['requests' => $requests]);
    }

    public function view($id)
    {
        $model = new MaintenanceRequestModel();
        $request = $model->select('maintenance_requests.*, users.name AS tenant_name, properties.address AS property_address')
            ->join('users', 'users.id = maintenance_requests.tenant_id')
            ->join('properties', 'properties.id = maintenance_requests.property_id')
            ->where('maintenance_requests.id', $id)
            ->first();

        return view('landlord/maintenance/view', ['request' => $request]);
    }

    public function updateStatus($id)
    {
        $model = new MaintenanceRequestModel();
        $status = $this->request->getPost('status');

        $model->update($id, [
            'status' => $status,
            'resolved_at' => $status === 'resolved' ? date('Y-m-d H:i:s') : null
        ]);

        return redirect()->back()->with('success', 'Status updated.');
    }
}
