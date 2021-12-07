<?php
declare(strict_types=1);

namespace App\Http\Traits\Web\Startup;
use Intervention\Image\Facades\Image;

trait StartUpTrait
{

    protected function uploadStartUpAvatar(object $startUpLogo): string
    {
        Image::make($startUpLogo)->resize(200, 200)->save(public_path("storage/startup-avatar/" . $startUpLogo->hashName()));
        return $startUpLogo->hashName();
    }

    protected function deleteInstructorAvatar(object $user): void
    {
        (file_exists(public_path('storage/instructor-avatar/' . $user->avatar)) && $user->avatar != 'default.png' )
            ? unlink(public_path('storage/instructor-avatar/' . $user->avatar)) : false;
    }

}
