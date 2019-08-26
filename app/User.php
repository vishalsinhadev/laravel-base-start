<?php
/**
 * @author	 : Vishal Kumar Sinha <vishalsinhadev@gmail.com>
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User as BaseUser;

class User extends BaseUser
{

    const ROLE_ADMIN = 1;

    const ROLE_USER = 2;

    public static $userRoles = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_USER => 'User'
    ];

    public static $roles = [
        self::ROLE_ADMIN => 'admin',
        self::ROLE_USER => 'user'
    ];

    public static function getRole($id)
    {
        return array_key_exists($id, static::$userRoles) ? static::$userRoles[$id] : 'Not Defined';
    }

    static public function getUserByRole($role, $pageSize = 15)
    {
        $model = self::whereRoleId($role);
        return self::getListPagination($model, $pageSize);
    }

    public function isAdmin()
    {
        return $this->role_id == self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role_id == self::ROLE_USER;
    }

    public function isRole(...$roles)
    {
        $user = auth()->user();

        if ($user->isAdmin())
            return true;

        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role)
    {
        $role = array_search($role, static::$roles);

        if (in_range($role, 0, 2)) {
            return $this->role_id == $role;
        }

        return false;
    }
    //
}