<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use  SimpleSoftwareIO\QrCode\Facades\QrCode;
class QR_code_Controller extends Controller
{
    public function process_form(Request $request)
    {

        $input_data = $request->input('qr_code_link');

        // Вызов функции для обработки данных
        $qr_code = QrCode::size(275)->generate($input_data);

        return view('result', compact('qr_code'));
    }


}
