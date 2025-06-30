<?php

namespace App\Controllers\Landlord;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\LeaseModel;
use App\Models\UserModel;

class PaymentController extends BaseController
{
    public function index()
    {
        $paymentModel = new PaymentModel();
        $payments = $paymentModel->findAll();
        return view('landlord/payments/index', ['payments' => $payments]);
    }

    public function create()
    {
        $userModel = new \App\Models\UserModel();
        $leaseModel = new \App\Models\LeaseModel();

        $tenants = $userModel->where('role', 'tenant')->findAll();
        $leases = $leaseModel->findAll(); // For AJAX filtering later

        return view('landlord/payments/create', [
            'tenants' => $tenants,
            'leases' => $leases
        ]);
    }

    public function store()
    {
        $rules = [
            'lease_id'   => 'required',
            'amount'     => 'required|decimal',
            'date_paid'  => 'required|valid_date',
            'method'     => 'required',
            'status'     => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $paymentModel = new \App\Models\PaymentModel();
        $paymentModel->save([
            'lease_id'   => $this->request->getPost('lease_id'),
            'amount'     => $this->request->getPost('amount'),
            'date_paid'  => $this->request->getPost('date_paid'),
            'method'     => $this->request->getPost('method'),
            'status'     => $this->request->getPost('status')
        ]);

        return redirect()->to('/landlord/payments')->with('success', 'Payment recorded successfully.');
    }

    public function edit($id)
    {
        $model = new PaymentModel();
        $payment = $model->find($id);

        if (!$payment) {
            return redirect()->to('/landlord/payments')->with('error', 'Payment not found.');
        }

        return view('landlord/payments/edit', ['payment' => $payment]);
    }

    public function update($id)
    {
        $rules = [
            'amount'     => 'required|decimal',
            'date_paid'  => 'required|valid_date',
            'method'     => 'required',
            'status'     => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $model = new PaymentModel();

        $receipt = $this->request->getFile('receipt');
        $fileName = $this->request->getPost('old_receipt');

        if ($receipt && $receipt->isValid() && !$receipt->hasMoved()) {
            $fileName = $receipt->getRandomName();
            $receipt->move('uploads/payments/', $fileName);
        }

        $model->update($id, [
            'amount'     => $this->request->getPost('amount'),
            'date_paid'  => $this->request->getPost('date_paid'),
            'method'     => $this->request->getPost('method'),
            'status'     => $this->request->getPost('status'),
            'receipt'    => $fileName,
        ]);

        return redirect()->to('/landlord/payments')->with('success', 'Payment updated successfully.');
    }
}
