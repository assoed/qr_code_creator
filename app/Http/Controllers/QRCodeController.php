<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use  SimpleSoftwareIO\QrCode\Facades\QrCode;
class QRCodeController extends Controller
{
    public function process_form(Request $request)
    {

        $link  = $request->input('qr_code_link');
        $color = $request->input('qr_code_color');
        $color = hex_to_rgb($color);

        // Вызов функции для обработки данных
        return QrCode::size(275)
            ->color($color[0], $color[1],$color[2])
            ->generate($link);




    }





}
//функция которая конвертирует hex в rgb
function hex_to_rgb($hex):array {
    // Удаляем символ # (если он есть)
    $hex = str_replace('#', '', $hex);

    // Получаем отдельные значения для красного, зеленого и синего цветов
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Возвращаем значения в виде строки RGB
    return [$r, $g, $b];
}
