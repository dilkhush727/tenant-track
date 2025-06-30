<?php namespace App\Controllers\Landlord;

use CodeIgniter\Controller;
use App\Models\AnnouncementModel;
use App\Models\LeaseModel;
use App\Models\PaymentModel;
use App\Models\MaintenanceRequestModel;

class Main extends Controller
{
    public function index()
    {
        // Get the landlord's ID from session
        $landlordId = session()->get('user_id');

        // Load necessary models
        $announcementModel = new AnnouncementModel();
        $leaseModel = new LeaseModel();
        $paymentModel = new PaymentModel();
        $maintenanceModel = new MaintenanceRequestModel();

        // Get announcements
        $announcements = $announcementModel->getForRole('landlord');

        // Get report data
        $data = [
            'name' => session('name'),
            'announcements' => $announcements,
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

        // Return the view with all the data
        return view('landlord/main', $data);
    }
}
