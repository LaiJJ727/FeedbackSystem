<?php
namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Services
{
    public function ImageResizeService($image, $storingFolder)
    {
        $imageName = null;
        if ($image) {
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path($storingFolder);
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $newImgWidth = $img->width() * 0.75;
            $img->scaleDown(width:$newImgWidth);
            //$img->scaleDown(height:500);
            //images is the location
            $img->save($destinationPath.'/'.$imageName); 
        }
        return $imageName;          
    }

    public function sendWhatsappMessage(array $recipients, $message){
        $client = new Client($_ENV['TWILIO_SID'], $_ENV['TWILIO_AUTH_TOKEN']);
        foreach ($recipients as $recipient) {
            // dump($_ENV['TWILIO_WHATSAPP_FROM']);
            // dump($recipient['phone']);
            $phoneNum =$recipient['phone'];
            $countryCode = '60';
            if (strpos($phoneNum, '0') === 0) {
                // Remove the leading '0'
                $phoneNum = substr($phoneNum, 1);
            }
            if (strpos($phoneNum, $countryCode) !== 0) {
                // If not, add the country code
                $phoneNum = $countryCode . $phoneNum;
            }
            $client->messages->create(
                "whatsapp:{$phoneNum}",
                [
                    'from' => "whatsapp:".$_ENV['TWILIO_WHATSAPP_FROM'],
                    'body' => $message,
                ]
            );
        }
    }
}

?>