<?php

namespace Rootscratch\SMS;

class Send extends Configuration
{

    public function sendSingleMessage($number, $message, $device = 0, $schedule = null, $isMMS = false, $attachments = null, $prioritize = false)
    {
        $url = parent::SERVER . "/services/send.php";
        $postData = array(
            'number' => $number,
            'message' => $message,
            'schedule' => $schedule,
            'key' => parent::getApiKey(),
            'devices' => $device,
            'type' => $isMMS ? "mms" : "sms",
            'attachments' => $attachments,
            'prioritize' => $prioritize ? 1 : 0
        );
        return $this->sendRequest($url, $postData);
    }


    public function sendMessages($messages, $option = parent::USE_SPECIFIED, $devices = [], $schedule = null, $useRandomDevice = false)
    {
        $url = parent::SERVER . "/services/send.php";
        $postData = [
            'messages' => json_encode($messages),
            'schedule' => $schedule,
            'key' => parent::$API_KEY,
            'devices' => json_encode($devices),
            'option' => $option,
            'useRandomDevice' => $useRandomDevice
        ];
        return $this->sendRequest($url, $postData);
    }



    public function sendMessageToContactsList($listID, $message, $option = USE_SPECIFIED, $devices = [], $schedule = null, $isMMS = false, $attachments = null)
    {
        $url = parent::SERVER . "/services/send.php";
        $postData = [
            'listID' => $listID,
            'message' => $message,
            'schedule' => $schedule,
            'key' => parent::$API_KEY,
            'devices' => json_encode($devices),
            'option' => $option,
            'type' => $isMMS ? "mms" : "sms",
            'attachments' => $attachments
        ];
        return $this->sendRequest($url, $postData);
    }


}
