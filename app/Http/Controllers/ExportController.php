<?php

namespace App\Http\Controllers;

use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\officer;
use App\Models\OfficialMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ExportController extends Controller
{
    public function toPdf(){
        $officialMember = OfficialMember::all();
        $depositor = Depositor::get();
        $branch = Branch_under::all();
        $officer = officer::all()->where('relation_id', Auth::user()->id);
        $pdf = PDF::loadView('pdf.members', compact('depositor', 'branch', 'officialMember', 'officer'));
       
        return $pdf->stream("Members.pdf");
       // return $pdf->download('Members.pdf');
    }
}
