<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    const TYPE_ANDROID = 'a';

    const TYPE_IOS = 'i';

    protected $table = 'userdevices';

    protected $primaryKey = 'UserDevicesId';

    protected $keyType = 'Id';

    public function user()
    {
        return $this->belongsTo('user', 'UserId', 'UserId');
    }

    static public function getDevices($user_id, $device_type)
    {
        $countdevices = self::where('DeviceType', '=', $device_type)->where('UserId', '=', $user_id)->get();
        $devicetoken = array();
        if (count($countdevices) > 0) {
            foreach ($countdevices as $value) {
                if ($value['DeviceId'] != '' && strlen($value['DeviceId']) > 30)
                    $devicetoken[] = $value['DeviceId'];
            }
        }
        return $devicetoken;
    }
}