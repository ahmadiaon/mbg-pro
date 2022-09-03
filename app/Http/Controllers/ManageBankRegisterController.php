<?php

namespace App\Http\Controllers;

use App\Models\CommunityRegister;
use App\Models\FinancialServiceRegister;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use PDF;
use Illuminate\Support\Facades\Mail;


class ManageBankRegisterController extends Controller
{
    public function index()
    {
        // $from = date('2022-3-01');
        // $to = date('2022-03-10');

        // return FinancialServiceRegister::whereBetween('updated_at', [$from, $to])->get();
        // return CommunityRegister::join('communities', 'communities.uuid', '=', 'community_registers.community_uuid')->get(['community_registers.*', 'community_registers.name as nama', 'communities.name']);
        // return FinancialServiceRegister::latest()->get();
        return view('dashboard.manage.bankregister.index', [
            'title'         => 'Bank Register',
        ]);
    }
    public function anyData()
    {
        return Datatables::of(FinancialServiceRegister::latest())
            ->addColumn('action', function ($model) {
                return '<button onclick="myFunction(' . $model->id . ')"  type="button" class="btn btn-danger  py-1 px-2"><i class="icon-copy dw dw-trash"></i></button>';
            })
            ->make(true);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(FinancialServiceRegister $financialServiceRegister)
    {
        //
    }


    public function edit(FinancialServiceRegister $financialServiceRegister)
    {
        //
        return $financialServiceRegister;
    }


    public function update(Request $request, FinancialServiceRegister $financialServiceRegister)
    {
        //
    }

    public function destroy(FinancialServiceRegister $financialServiceRegister)
    {
        FinancialServiceRegister::destroy($financialServiceRegister->id);
        return redirect('/bank-register')->with('success', 'Financial Register has been Deleted!');
    }
    public function sendData(Request $request)
    {
        $from =  date('Y-m-d', strtotime($request->date_start));
        $to = date('Y-m-d', strtotime($request->date_end));
        // return FinancialServiceRegister::whereBetween('updated_at', [$from, $to])->get();
        $data["email"] = "dataahmadi2021@gmail.com";
        $data["title"] = "From digi.com";
        $data["body"] = "This is Demo";
        $data["content"] = "This is Demo";
        $data["datas"] = FinancialServiceRegister::join('financial_services', 'financial_services.uuid', '=', 'financial_service_registers.financial_service_uuid')
        ->where('financial_services.uuid', "ini-uuid-financial-services-seeder-1")
        ->get()
        ->first();

        
        $pdf = PDF::loadView('reportMail', $data);
       
        $pdf->save('images/pdf/' . 'ujang.pdf'); return $pdf->stream();
        session()->put('email', 'id');
         Mail::send('contenMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
        return view('dashboard.manage.bankregister.index', [
            'title'         => 'Bank Register',
        ]);
    }

}
