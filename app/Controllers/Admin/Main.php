<?php namespace App\Controllers\Admin;

use App\Models\AnnouncementModel;
use App\Models\LeaseModel;
use App\Models\PaymentModel;
use App\Models\MaintenanceRequestModel;
use CodeIgniter\Controller;

class Main extends Controller
{
    public function index()
    {
        // Announcement Model to fetch announcements
        $announcementModel = new AnnouncementModel();
        $announcements = $announcementModel->orderBy('created_at', 'DESC')->findAll();

        // Report data
        $leaseModel = new LeaseModel();
        $paymentModel = new PaymentModel();
        $maintenanceModel = new MaintenanceRequestModel();

        // Total number of leases
        $leaseCount = $leaseModel->countAllResults();

        // Total payments collected
        $paymentTotal = $paymentModel
            ->selectSum('amount')
            ->where('status', 'paid')
            ->first()['amount'] ?? 0;

        // Maintenance requests stats
        $pendingRequests = $maintenanceModel->where('status', 'submitted')->countAllResults();
        $resolvedRequests = $maintenanceModel->where('status', 'resolved')->countAllResults();

        // Pass the data to the view
        return view('admin/main', [
            'name' => session('name'),
            'announcements' => $announcements,
            'lease_count' => $leaseCount,
            'payment_total' => $paymentTotal,
            'maintenance_pending' => $pendingRequests,
            'maintenance_resolved' => $resolvedRequests
        ]);
    }
}
