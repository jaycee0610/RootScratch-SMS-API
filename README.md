
![Logo](https://repository-images.githubusercontent.com/793146864/6fb1ef96-255c-4946-bd88-3b26e7c17e3d)

# 📱 Android SMS Gateway (PHP)

Android SMS Gateway transforms your Android smartphone into an SMS gateway. It is a lightweight application that enables you to send SMS messages programmatically via an API, making it ideal for integrating SMS functionality into your applications or services.

- [https://packagist.org/packages/rootscratch/sms](https://packagist.org/packages/rootscratch/sms)
- [https://sms.rootscratch.com/](https://sms.rootscratch.com/)

## 🚀 Installation

To install the `rootscratch/sms` via Composer, run the following command:

```bash
composer require rootscratch/sms
```

## 📖 Usage/Examples

To use the Rootscratch SMS in your PHP project, include the Composer autoloader:

```php
require_once __DIR__ . '/vendor/autoload.php';

use Rootscratch\SMS\Configuration;
$configuration = new Configuration();

// Set API Key
$configuration->setApiKey('your_api_key');
```

## ⚙️ Configuration Usage

```php
/**
 * Configuration
 * 
 * Get Devices = getDevices()
 * Get Balance = getBalance()
 * 
 * Get Message By ID = getMessageByID($id) : if $id int = message id, if $id string = group id
 * 
 * Get Message By Status = getMessagesByStatus($status, $deviceID = null, $simID = null, $time = null, $endTimestamp = null)
 * Get messages "received" on SIM 1 of device ID 8 in last 24 hours = getMessagesByStatus("Received", 8, 0, time() - 86400)
 * 
 * Get USSD Request By ID = getUssdRequestByID($id)
 * Get USSD requests with request text "*150#" sent in last 24 hours. = getUssdRequests("*150#", null, null, time() - 86400)
 * 
 * Add a new contact to contacts list 1 or resubscribe the contact if it already exists. = addContact(1, "+11234567890", "Test", true);
 * Unsubscribe a contact using the mobile number. = unsubscribeContact(1, "+11234567890");
 * 
 */
echo json_encode($configuration->getDevices(), JSON_PRETTY_PRINT);
```

## 📤 Send Single SMS

```php
use Rootscratch\SMS\Send;
$sendMessage = new Send();

$send_single = $sendMessage->sendSingleMessage('mobile_number', 'Message');

echo json_encode($send_single, JSON_PRETTY_PRINT);
```

## 📥 Send Bulk Message

```php
$send_bulk = $sendMessage->sendMessages([
    [
        "number" => "6391234567890",
        "message" => "Message 1"
    ],
    [
        "number" => "6391234567891",
        "message" => "Message 2"
    ]
]);
echo json_encode($send_bulk, JSON_PRETTY_PRINT);
```

## 🖼️ Send MMS Sample

- Use All Sims = sendMessages(messages = array, option = USE_ALL_SIMS)
- Use All Devices = sendMessages(messages = array, option = USE_ALL_DEVICES)
- Use Specified Devices = sendMessages(messages = array, option = USE_SPECIFIED, devices = array)

```php
/**
 * Send MMS Sample
 * Use All Sims = sendMessages(messages = array, option = USE_ALL_SIMS)
 * Use All Devices = sendMessages(messages = array, option = USE_ALL_DEVICES)
 * Use Specified Devices = sendMessages(messages = array, option = USE_SPECIFIED, devices = array)
 */

$send_bulk_mms = $sendMessage->sendMessages([
    [
        "number" => "639123456789",
        "message" => "Test 1",
        "type" => "mms",
        "attachments" => 'https://sample.com/1.png'
    ],
    [
        "number" => "639123456789",
        "message" => "Test 2",
        "type" => "mms",
        "attachments" => 'https://sample.com/1.png'
    ]
]);
echo json_encode($send_bulk_mms, JSON_PRETTY_PRINT);
```

## 📇 Send Message To Contacts List

Send a message on **schedule** to contacts in contacts list with ID of 1.

```php
$sendMessage->sendMessageToContactsList(1, "Test", null, null, strtotime("+2 minutes"));
```

Send a message to contacts in contacts list with ID of 1.

```php
$send_contact_list = $sendMessage->sendMessageToContactsList(
    1,
    'Via Contact List!',
    Configuration::USE_SPECIFIED,
    [4]
);
echo json_encode($send_contact_list, JSON_PRETTY_PRINT);
```

## 📲 Send USSD Request

Send a USSD request using the default SIM of Device ID 1.

```php
$send_ussd = $sendMessage->sendUssdRequest('*150#', 1);
echo json_encode($send_ussd, JSON_PRETTY_PRINT);
```

Send a USSD request using SIM in **slot 1** of Device ID 1.

```php
$send_ussd = $sendMessage->sendUssdRequest('*150#', 1, 0);
echo json_encode($send_ussd, JSON_PRETTY_PRINT);
```

Send a USSD request using SIM in **slot 2** of Device ID 1.

```php
$send_ussd = $sendMessage->sendUssdRequest('*150#', 1, 1);
echo json_encode($send_ussd, JSON_PRETTY_PRINT);
```

## 🔄 Resend SMS

```php
/**
 * Resend SMS Sample
 * Resend Message By ID = resendMessageByID(id = int)
 * Resend Messages By Group ID = resendMessagesByGroupID(group_id = string, status = string)
 */

use Rootscratch\SMS\Resend;

$resend = new Resend();

$resend_by_id = $resend->resendMessagesByGroupID('MZ7QabWteHWfSkjkgX67acc67bcc2048.73874662', 'Failed');
echo json_encode($resend_by_id, JSON_PRETTY_PRINT);
```

## 🛠️ Support

For support, please email me at jaycee@rootscratch.com.

