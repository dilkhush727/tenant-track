<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\LeaseModel;

class LeaseController extends BaseController
{
    public function index()
    {
        $tenantId = session()->get('user_id');
        $model = new LeaseModel();

        $leases = $model->where('tenant_id', $tenantId)->findAll();

        return view('tenant/leases/index', ['leases' => $leases]);
    }
}
