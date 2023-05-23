<?php

namespace App\Http\Controllers;

use App\Models\Depositor;
use App\Models\OfficialMember;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcelController extends Controller
{
    public function exportMemberExcel(){
        $officialMember = OfficialMember::all();
        $depositor = Depositor::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue("A1" , "Oro Integrated Cooperative - Youth Savers Club Members");
        $sheet->setCellValue("A2" , "Report: Members List");
        $sheet->setCellValue("A3" , "Report Date:".date("M d Y"));
        $sheet->setCellValue("A4" , "");
        $sheet->setCellValue("A5" , "");
        $sheet->setCellValue("A6" , "Firstname");
        $sheet->setCellValue("B6" , "Middlename");
        $sheet->setCellValue("C6" , "Lastname");
        $sheet->setCellValue("D6" , "BirthDate");
        $sheet->setCellValue("E6" , "Contact No");
        $sheet->setCellValue("F6" , "Date Officially Member");

        $count = 7;
        
        foreach($officialMember as $officialInfo){
            foreach($depositor as $depositorInfo){
                if($officialInfo->depositor_id == $depositorInfo->depositor_id){
                    $sheet->setCellValue("A".$count, $depositorInfo->firstname);
                    $sheet->setCellValue("B".$count, $depositorInfo->middlename);
                    $sheet->setCellValue("C".$count, $depositorInfo->lastname);
                    $sheet->setCellValue("D".$count, $depositorInfo->date_of_birth);
                    $sheet->setCellValue("E".$count, $depositorInfo->contact_no);
                    $sheet->setCellValue("F".$count, $depositorInfo->created_at);
                    $count++;
                }
            }
        }

        // Add data to the sheet
        // ...

        // Save the sheet as an Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('MembersData.xlsx');

        // Download the file
        return response()->download('MembersData.xlsx');
    }
}
