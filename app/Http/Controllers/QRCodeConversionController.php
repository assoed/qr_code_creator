<?php

//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use Spatie\Image\Image;
//use Symfony\Component\Process\Process;
//
//use Spatie\Image\Manipulations;
//
//class QRCodeConversionController extends Controller
//{
//    public function convertSVG(Request $request)
//    {
//        $format = $request->input('format');
//        $svgData = $request->input('svgData');
//
//        // Generate a temporary file to store the SVG
//        $tempSvgFilePath = tempnam(sys_get_temp_dir(), 'svg');
//        file_put_contents($tempSvgFilePath, $svgData);
//
//        // Use spatie/image to convert SVG to the desired format
//        $convertedImagePath = tempnam(sys_get_temp_dir(), 'image');
//        Image::load($tempSvgFilePath)
//            ->format($format)
//            ->save($convertedImagePath);
//
//        // Retrieve the converted image data
//        $convertedData = file_get_contents($convertedImagePath);
//
//        // Clean up temporary files
//        unlink($tempSvgFilePath);
//        unlink($convertedImagePath);
//
//
//
//        if($format ==='eps'){
//            $values='application/postscript';
//        }
//        elseif($format ==='pdf'){
//        $values='application/postscript';
//        }
//        elseif ($format ==='svg'){
//            $values='image/svg';
//        }
//        else{
//            $values='image/png';
//        }
//        // Return the converted data as a downloadable response
//        return response($convertedData)
//            ->header('Content-Type', ".$values")
//            ->header('Content-Disposition', "attachment; filename=generated_qr.$format");
//    }
//}

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Image\Image;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Storage;

class QRCodeConversionController extends Controller
{
    //передаем svg файл сформированный из html и отдаем на загрузку файл в нужном формате
    public function convertSVG(Request $request)
    {
        $format = $request->input('format');
        $svgData = $request->input('svgData');

        // Generate a temporary file to store the SVG
        $tempSvgFilePath = tempnam(sys_get_temp_dir(), 'svg');
        file_put_contents($tempSvgFilePath, $svgData);

        if ($format === 'svg') {
            // для svg формата просто отдаем svg
            return Response::make($svgData)
                ->header('Content-Type', 'image/svg+xml')
                ->header('Content-Disposition', "attachment; filename=generated_qr.$format");
        } elseif ($format === 'png') {
            //  конвертируем svg в png
            $pngImage = new \Imagick();
            $pngImage->readImageBlob($svgData);
            $pngImage->setImageFormat('png');
            $pngImageData = $pngImage->getImageBlob();

            return Response::make($pngImageData)
                ->header('Content-Type', 'image/png')
                ->header('Content-Disposition', "attachment; filename=generated_qr.$format");
        } elseif ($format === 'pdf' || $format === 'eps') {
            // конвертируем svg в png, потому svg не пишется напрямую в pdf eps
            $pngImage = new \Imagick();
            $pngImage->readImageBlob($svgData);
            $pngImage->setImageFormat('png');
            $pngImageData = $pngImage->getImageBlob();

            // конвертируем png в eps или pdf
            $pdfOrEpsImage = new \Imagick();
            $pdfOrEpsImage->readImageBlob($pngImageData);
            $pdfOrEpsImage->setImageFormat($format);
            $pdfOrEpsImageData = $pdfOrEpsImage->getImageBlob();

            return Response::make($pdfOrEpsImageData)
                ->header('Content-Type', $this->getContentType($format))
                ->header('Content-Disposition', "attachment; filename=generated_qr.$format");
        }
    }

    private function getContentType($format)
    {
        if ($format === 'eps') {
            return 'application/postscript';
        } elseif ($format === 'pdf') {
            return 'application/pdf';
        } elseif ($format === 'svg') {
            return 'image/svg+xml';
        } else {
            return 'image/png';
        }
    }
}
