<?php

namespace App\Http\Controllers\Charity;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    public function AllAuditLogs(){

        $logs = AuditLog::where('charitable_organization_id', Auth::user()
                    ->charitable_organization_id)
                    ->orderByDesc('performed_at')
                    ->get();


        return view('charity.audits.all',compact('logs'));

       
    } // End Method
}
