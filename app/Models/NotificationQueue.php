<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

class NotificationQueue extends Model
{

    const STATUS_PENDING = 0;

    const STATUS_SENT = 1;

    const STATUS_FAILED = 2;

    protected $fillable = [
        'userid',
        'message',
        'title',
        'type',
        'modulename',
        'status',
        'venueid',
        'lastsentime',
        'readnotification',
        'error_message'
    ];

    static public function add($param = [])
    {
        $model = new self();
        $model->message = $param['message'];
        $model->title = $param['title'];
        $model->type = $param['type'];
        $model->modulename = $param['modulename'];
        $model->userid = $param['userid'];
        $model->venueid = $param['venueid'];
        $model->status = self::STATUS_PENDING;
        $model->save();
    }

    static public function sendExpoNotification($title, $body, $userId, $moduleName, $venueId, $type)
    {
        $badgeCount = NotificationQueue::where('userid', '=', $userId)->where('readnotification', '=', '0')
            ->where('status', '=', NotificationQueue::STATUS_SENT)
            ->count();

        $recipients = Devices::selectRaw('DISTINCT `DeviceId`')->where([
            'UserId' => $userId
        ])
            ->pluck('DeviceId')
            ->toArray();

        $badgeCount += 1;
        // try {
        if (count($recipients) > 0) {
            $message = (new ExpoMessage())->setTitle($title)
                ->setBody($body)
                ->setData([
                    'module_name' => $moduleName,
                    'venueid' => $venueId,
                    'type' => $type
                ])
                ->setBadge($badgeCount)
                ->setChannelId('default')
                ->playSound();

            $expo = Expo::driver('file');

            $response = $expo->send($message)
                ->to($recipients)
                ->push();

            $data = $response->getData();
            return $data;
        }
    }

    public function changeStatus($status, $message = null)
    {
        $cdate = date('Y-m-d H:i:s');
        return $this->update([
            'status' => $status,
            'lastsentime' => $cdate,
            'error_message' => $message
        ]);
    }
}
