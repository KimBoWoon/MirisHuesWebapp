<?php

/**
 * Created by PhpStorm.
 * User: Null
 * Date: 2017-02-21
 * Time: 오후 4:50
 */

namespace App\Http\Controllers\Notification;

class Send
{
    public function send()
    {
        $noti = new AndroidNotification("Endpoint=sb://miris-namespace.servicebus.windows.net/;SharedAccessKeyName=DefaultListenSharedAccessSignature;SharedAccessKey=ggFB0Rqa4wtfP+M22vEr3QzEXAWTYqJgEKn9TCJ2qHI=", "miris-notification");
        $noti->sendNotification("asdf", "asdf");
    }
}