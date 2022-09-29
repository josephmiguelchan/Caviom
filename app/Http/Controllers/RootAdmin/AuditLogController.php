<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function viewAllAudits()
    {
        $audits = AuditLog::get();
        return view('admin.main.audits.all', compact('audits'));
    }
}
