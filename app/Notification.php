<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class Notification extends Model
{
    /**
     * Notification setup.
     */
    public function setup($for_user,$title,$payload,$type,$from_id)
    {
        $this->user_id =$for_user;
        $this->title =$title;
        $this->payload =$payload;
        $this->type =$type;
        $this->from_id =$from_id;

        $this->sendNotification();
        $this->save();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }




    public function sendNotification(){
		$auth = [
			'VAPID' => [
				'subject' => getenv("VAPID_SUBJECT"), // can be a mailto: or your website address
				'publicKey' => getenv("VAPID_PUBLIC_KEY"), // (recommended) uncompressed public key P-256 encoded in Base64-URL
				'privateKey' => getenv("VAPID_PRIVATE_KEY"), // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
			]
		];
		
		$webPush = new WebPush($auth);
		$webPush->setAutomaticPadding(0);
		$subscriptions = $this->authUser()->notificationEndpoints();
		//$icon = User::where('id', $this->from_id)->get()->first()->profilePicture;
		
		foreach($subscriptions as $sub) {
			$webPush->sendNotification(
				Subscription::create(
					json_decode($sub->endpoint, true)
				),
				'{"type": '.$this->type.', "text": "'.$this->payload.'", "title": "'.$this->title.'", "icon": "speck"}'
				//"{'type': {$this->type}, 'text': '{$this->payload}', 'title': '{.$this->title}', 'icon': '{$icon}'}"
			);
		}
		
		foreach ($webPush->flush() as $report) {
			$endpoint = $report->getRequest()->getUri()->__toString();

			if ($report->isSuccess()) {
				Log::info("[v] Message sent successfully for subscription {$endpoint}.");
			} else {
				Log::error("[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}");
			}
		}
		
    }
}
