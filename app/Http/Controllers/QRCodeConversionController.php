<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Image\Image;
use Symfony\Component\Process\Process;
class QRCodeConversionController extends Controller
{
    public function convertSVG(Request $request)
    {
        $format = $request->input('format');
        $svgData = urldecode($request->input('svgData'));

        // Generate a temporary file to store the SVG
        $tempSvgFilePath = tempnam(sys_get_temp_dir(), 'svg');
        file_put_contents($tempSvgFilePath, $svgData);

        // Generate a temporary file to store the converted image
        $tempImageFilePath = tempnam(sys_get_temp_dir(), 'image');

        // Use ImageMagick to convert SVG to the desired format
        $command = "convert $tempSvgFilePath $tempImageFilePath";
        $process = Process::fromShellCommandline($command);
        $process->run();

        // Retrieve the converted image data
        $convertedData = file_get_contents($tempImageFilePath);

        // Clean up temporary files
        unlink($tempSvgFilePath);
        unlink($tempImageFilePath);

        // Return the converted data as a downloadable response
        return response($convertedData)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "attachment; filename=generated_qr.$format");
    }
}
