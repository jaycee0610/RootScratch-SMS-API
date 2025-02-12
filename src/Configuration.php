<?php

namespace  Rootscratch\SMS;


class Configuration
{
    public const VERSION = '1.0.0';
    public const SERVER = 'https://sms.rootscratch.com';
    protected static string $API_KEY;
    public const USE_SPECIFIED = 0;
    public const USE_ALL_DEVICES = 1;
    public const USE_ALL_SIMS = 2;

    public function __construct() {}

    public static function setApiKey(string $key)
    {
        self::$API_KEY = $key;
    }


    public static function getApiKey(): string
    {
        return self::$API_KEY ?? '';
    }

    public function getDevices()
    {
        $url = self::SERVER . "/services/get-devices.php";
        $postData = [
            'key' => self::$API_KEY
        ];
        return  $this->sendRequest($url, $postData)["devices"];
    }


    public function getBalance()
    {
        $url = self::SERVER . "/services/send.php";
        $postData = [
            'key' => self::$API_KEY
        ];
        $credits = $this->sendRequest($url, $postData)["credits"];
        return $credits === null ? ['credits' => "Unlimited"] : ['credits' => $credits];
    }


    public function getMessageByID($id = null)
    {
        if (empty($id)) {
            return ['error' => 'ID is required.'];
        }

        $url = self::SERVER . "/services/read-messages.php";
        $postData = [
            'key' => self::$API_KEY,
            'id' => $id
        ];

        try {
            $response = $this->sendRequest($url, $postData);
            if (isset($response["messages"][0])) {
                return $response["messages"][0];
            } else {
                return ['error' => 'Unable to retrieve the message. Please try again. Ensure that id is an integer and group_id is correctly formatted.'];
            }
        } catch (\Exception $e) {
            return ['error' => 'Unable to retrieve the message. Please try again. Ensure that id is an integer and group_id is correctly formatted.'];
        }
    }

    public function getUssdRequestByID($id)
    {
        $url = self::SERVER . "/services/read-ussd-requests.php";
        $postData = [
            'key' => self::$API_KEY,
            'id' => $id
        ];
        return $this->sendRequest($url, $postData);
    }

    public function getUssdRequests($request, $deviceID = null, $simSlot = null, $startTimestamp = null, $endTimestamp = null)
    {
        $url = self::SERVER . "/services/read-ussd-requests.php";
        $postData = [
            'key' => self::$API_KEY,
            'request' => $request,
            'deviceID' => $deviceID,
            'simSlot' => $simSlot,
            'startTimestamp' => $startTimestamp,
            'endTimestamp' => $endTimestamp
        ];
        return $this->sendRequest($url, $postData);
    }

    public function getMessagesByStatus($status, $deviceID = null, $simSlot = null, $startTimestamp = null, $endTimestamp = null)
    {
        $url = self::SERVER . "/services/read-messages.php";
        $postData = [
            'key' => self::$API_KEY,
            'status' => $status,
            'deviceID' => $deviceID,
            'simSlot' => $simSlot,
            'startTimestamp' => $startTimestamp,
            'endTimestamp' => $endTimestamp
        ];
        return $this->sendRequest($url, $postData);
    }




    public function addContact($listID, $number, $name = null, $resubscribe = false)
    {
        $url = self::SERVER . "/services/manage-contacts.php";
        $postData = [
            'key' => self::$API_KEY,
            'listID' => $listID,
            'number' => $number,
            'name' => $name,
            'resubscribe' => $resubscribe
        ];
        return $this->sendRequest($url, $postData);
    }

    public function unsubscribeContact($listID, $number)
    {
        $url = self::SERVER . "/services/manage-contacts.php";
        $postData = [
            'key' => self::$API_KEY,
            'listID' => $listID,
            'number' => $number,
            'unsubscribe' => true
        ];
        return $this->sendRequest($url, $postData);
    }

    public function sendUssdRequest($request, $device, $simSlot = null)
    {
        $url = self::SERVER . "/services/send-ussd-request.php";
        $postData = [
            'key' => self::$API_KEY,
            'request' => $request,
            'device' => $device,
            'sim' => $simSlot
        ];
        return $this->sendRequest($url, $postData)["request"];
    }

    public function sendRequest($url, $postData)
    {
        if (empty(self::$API_KEY)) {
            return ['error' => 'API Key is required.'];
        }

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->post($url, [
                'form_params' => $postData
            ]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            if ($statusCode == 200) {
                $json = json_decode($body, true);
                if ($json == false) {
                    if (empty($body)) {
                        return ['error' => 'Empty Response'];
                    } else {
                        return ['error' => $body];
                    }
                } else {
                    if ($json["success"]) {
                        return $json["data"];
                    } else {
                        return ['error' => $json['error']['message']];
                    }
                }
            } else {
                return ['error' => "HTTP Error Code : {$statusCode}"];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
