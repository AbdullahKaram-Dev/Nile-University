<?php
declare(strict_types=1);

namespace App\Http\Traits\Web\User;
use Intervention\Image\Facades\Image;

trait UserTrait
{
    protected function uploadUserAvatar(object $avatar): string
    {
        Image::make($avatar)->resize(200, 200)->save(public_path("storage/user-avatar/" . $avatar->hashName()));
        return $avatar->hashName();
    }

    protected function deleteUserAvatar(object $user): void
    {
        (file_exists(public_path('storage/user-avatar/' . $user->avatar)) && $user->avatar != 'default.png')
            ? unlink(public_path('storage/user-avatar/' . $user->avatar)) : false;
    }

    protected function userDefaultAvatar(): string
    {
        return "default.png";
    }
}
