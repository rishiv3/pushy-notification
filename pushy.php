<?php
   if(isset($_POST['submit']) ) {
    class PushyAPI {
        static public function sendPushNotification($data, $tokens) {
            // Insert your Secret API Key here
            $apiKey = 'YourSecretAPIKey';

            // Set post variables
            $post = array(
                'data'    => $data,
                'tokens'  => $tokens,
            );

            // Set Content-Type header since we're sending JSON
            $headers = array(
                'Content-Type: application/json'
            );

            // Initialize curl handle
            $ch = curl_init();

            // Set URL to Pushy endpoint
            curl_setopt($ch, CURLOPT_URL, 'https://api.pushy.me/push?api_key=' . $apiKey);

            // Set request method to POST
            curl_setopt($ch, CURLOPT_POST, true);

            // Set our custom headers
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Get the response back as string instead of printing it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Set post data as JSON
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

            // Actually send the push
            $result = curl_exec($ch);

            // Display errors
            if (curl_errno($ch)) {
                echo curl_error($ch);
            }

            // Close curl handle
            curl_close($ch);

            // Debug API response
            //header('Content-Type: application/json');
            return $result;
        }
    }

    // Payload data you want to send to devices
    $data = array('message' => $_POST['message'] );

    // The recipient device tokens
    $deviceTokens = array('Token1', 'Token2');

    // Send it with Pushy
    $result = PushyAPI::sendPushNotification($data, $deviceTokens);

}
?>
<html>
    <head>
        <title>Notification</title>
        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>


        <div class="container">
          <form id="contact" action="<?php $_PHP_SELF ?>" method="post">
            <h3>Notification Form</h3>
            <!-- <h4>Type your notification message here</h4> -->
                <?php if (!empty($result)) { ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Notification Sent!</strong>
                </div>
                <?php } ?>
            <fieldset>
              <textarea placeholder="Type your notification message here...." tabindex="5" name="message" required></textarea>
            </fieldset>
            <fieldset>
              <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
            </fieldset>
          </form>
        </div>

    </body>
</html>
