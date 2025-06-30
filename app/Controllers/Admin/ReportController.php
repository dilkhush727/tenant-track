<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LeaseModel;
use App\Models\PaymentModel;
use App\Models\MaintenanceRequestModel;

class ReportController extends BaseController
{
    public function index()
    {
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

        return view('admin/reports/index', [
            'lease_count' => $leaseCount,
            'payment_total' => $paymentTotal,
            'maintenance_pending' => $pendingRequests,
            'maintenance_resolved' => $resolvedRequests
        ]);
    }

    public function exportLeasesCSV()
    {
        $leases = (new LeaseModel())->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="leases.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Tenant ID', 'Property ID', 'Start Date', 'End Date', 'Monthly Rent', 'Created At']);

        foreach ($leases as $lease) {
            fputcsv($output, [
                $lease['id'],
                $lease['tenant_id'],
                $lease['property_id'],
                $lease['start_date'],
                $lease['end_date'],
                $lease['monthly_rent'],
                $lease['created_at'],
            ]);
        }

        fclose($output);
        exit;
    }

    public function exportPaymentsCSV()
    {
        $payments = (new PaymentModel())->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="payments.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Lease ID', 'Amount', 'Date Paid', 'Method', 'Status']);

        foreach ($payments as $payment) {
            fputcsv($output, [
                $payment['id'],
                $payment['lease_id'],
                $payment['amount'],
                $payment['date_paid'],
                $payment['method'],
                $payment['status'],
            ]);
        }

        fclose($output);
        exit;
    }

    public function exportMaintenanceCSV()
    {
        $requests = (new MaintenanceRequestModel())->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="maintenance_requests.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Tenant ID', 'Property ID', 'Issue Type', 'Description', 'Status', 'Submitted At', 'Feedback']);

        foreach ($requests as $req) {
            fputcsv($output, [
                $req['id'],
                $req['tenant_id'],
                $req['property_id'],
                $req['issue_type'],
                $req['description'],
                $req['status'],
                $req['submitted_at'],
                $req['feedback']
            ]);
        }

        fclose($output);
        exit;
    }
}
