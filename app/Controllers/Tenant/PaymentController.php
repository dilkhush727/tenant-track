<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\LeaseModel;

class PaymentController extends BaseController
{
    public function index()
    {
        $tenantId = session()->get('user_id');

        // Get leases for this tenant
        $leaseModel = new LeaseModel();
        $leases = $leaseModel->where('tenant_id', $tenantId)->findAll();
        $leaseIds = array_column($leases, 'id');

        $paymentModel = new PaymentModel();

        // Get all payments associated with this tenant's leases
        $payments = !empty($leaseIds)
            ? $paymentModel->whereIn('lease_id', $leaseIds)->findAll()
            : [];

        return view('tenant/payments/index', ['payments' => $payments]);
    }
}