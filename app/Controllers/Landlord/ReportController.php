<?php

namespace App\Controllers\Landlord;

use App\Controllers\BaseController;
use App\Models\LeaseModel;
use App\Models\PaymentModel;
use App\Models\MaintenanceRequestModel;

class ReportController extends BaseController
{
    public function index()
    {
        $landlordId = session()->get('user_id');

        $leaseModel = new LeaseModel();
        $paymentModel = new PaymentModel();
        $maintenanceModel = new MaintenanceRequestModel();

        $data = [
            'lease_count' => $leaseModel->whereIn('property_id', function($builder) use ($landlordId) {
                return $builder->select('id')->from('properties')->where('landlord_id', $landlordId);
            })->countAllResults(),
            'payment_total' => $paymentModel
                ->join('leases', 'payments.lease_id = leases.id')
                ->join('properties', 'leases.property_id = properties.id')
                ->where('properties.landlord_id', $landlordId)
                ->selectSum('amount')->first()['amount'] ?? 0,
            'maintenance_pending' => $maintenanceModel
                ->whereIn('property_id', function($builder) use ($landlordId) {
                    return $builder->select('id')->from('properties')->where('landlord_id', $landlordId);
                })->where('status !=', 'resolved')->countAllResults(),
        ];

        return view('landlord/reports/index', $data);
    }
}