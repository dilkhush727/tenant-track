<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\LeaseModel;
use App\Models\PropertyModel;
use App\Models\AnnouncementModel;

class Main extends BaseController
{
    public function index()
    {
        $tenantId = session()->get('user_id');
        $leaseModel = new LeaseModel();
        $lease = $leaseModel->where('tenant_id', $tenantId)->first();

        $property = null;
        if ($lease) {
            $propertyModel = new PropertyModel();
            $property = $propertyModel->find($lease['property_id']);
        }

        // Fetch role-based announcements
        $announcementModel = new AnnouncementModel();
        $announcements = $announcementModel->getForRole('tenant');

        return view('tenant/main', [
            'lease' => $lease,
            'property' => $property,
            'announcements' => $announcements
        ]);
    }
}
