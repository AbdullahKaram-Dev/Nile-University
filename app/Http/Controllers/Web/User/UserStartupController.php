<?php
declare(strict_types=1);
namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\User\UserStartupInterface;
use Illuminate\Http\Request;

class UserStartupController extends Controller
{
    public UserStartupInterface $userStartupInterface;

    public function __construct(UserStartupInterface $userStartupInterface)
    {
        $this->userStartupInterface = $userStartupInterface;
    }

    public function showStartupInfo()
    {
        return $this->userStartupInterface->showStartupInfo();
    }
}
