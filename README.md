# Pushy Notification
Lightning-fast, highly-reliable push notification delivery

Send push notifications to devices with this PHP code sample.

The following code will send a push notification to devices with ````{message: "Hello World!"}```` as the payload.

````php
// Require Pushy API Class
require('pushy.php');

// Payload data you want to send to devices
$data = array('message' => 'Hello World!');

// The recipient device tokens
$deviceTokens = array('cdd92f4ce847efa5c7f');

// Send it with Pushy
PushyAPI::sendPushNotification($data, $deviceTokens);
````

Make sure to replace SECRET_API_KEY with your app's Secret API Key listed in the  [Dashboard](https://dashboard.pushy.me/).
