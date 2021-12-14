<?php
declare(strict_types=1);

namespace App\Http\Traits\Web\Deal;

use Intervention\Image\Facades\Image;

trait DealTrait
{
    protected function uploadDealLogo(object $dealLogo): string
    {
        Image::make($dealLogo)->resize(200, 200)->save(public_path("storage/deal-avatar/" . $dealLogo->hashName()));
        return $dealLogo->hashName();
    }
}
