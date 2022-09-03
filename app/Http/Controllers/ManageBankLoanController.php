<?php

namespace App\Http\Controllers;

use App\Models\FinancialServiceSubmission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class ManageBankLoanController extends Controller
{
    public function index()
    {
        // $aa = FinancialServiceSubmission::join('financial_services', 'financial_services.uuid', '=', 'financial_service_submissions.financial_service_uuid')->get();

        // return CommunityRegister::join('communities', 'communities.uuid', '=', 'community_registers.community_uuid')->get(['community_registers.*', 'community_registers.name as nama', 'communities.name']);
        // return $aa;
        return view('dashboard.manage.bankloan.index', [
            'title'         => 'Bank Loan',
        ]);
    }
    public function report()
    {
        // return CommunityRegister::join('communities', 'communities.uuid', '=', 'community_registers.community_uuid')->get(['community_registers.*', 'community_registers.name as nama', 'communities.name']);

        return view('reportMail', [
            'title'         => 'Bank Loan',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(FinancialServiceSubmission::latest())
            ->addColumn('action', function ($model) {
                return '<button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })


            ->make(true);
    }
    public function destroy($financialServiceRegister)
    {
        FinancialServiceSubmission::destroy($financialServiceRegister);
        return redirect('/bank-loan')->with('success', 'Financial Register Loan has been Deleted!');
    }

}
