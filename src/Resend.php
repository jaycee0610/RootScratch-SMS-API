<?php

namespace Rootscratch\SMS;

class Resend extends Configuration
{


    public function resendMessageByID($id)
    {
        $url = parent::SERVER . "/services/resend.php";
        $postData = [
            'key' => parent::$API_KEY,
            'id' => $id
        ];
        return $this->sendRequest($url, $postData);
    }

    public function resendMessagesByGroupID($groupID, $status)
    {
        $url = parent::SERVER . "/services/resend.php";
        $postData = [
            'key' => parent::$API_KEY,
            'group_id' => $groupID,
            'status' => $status
        ];
        return $this->sendRequest($url, $postData);
    }


    public function resendMessagesByStatus($status, $deviceID = null, $simID = null, $startTimestamp = null, $endTimestamp = null)
    {
        $url = parent::SERVER . "/services/resend.php";
        $postData = [
            'key' => parent::$API_KEY,
            'status' => $status,
            'deviceID' => $deviceID,
            'simID' => $simID,
            'startTimestamp' => $startTimestamp,
            'endTimestamp' => $endTimestamp
        ];
        return $this->sendRequest($url, $postData);
    }
}
