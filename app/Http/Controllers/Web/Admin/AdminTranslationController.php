<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminTranslationController extends Controller
{
    public function index():View
    {
        return view('admin.translation.index',['languages' => config('app.languages_files')]);
    }

    public function edit($fileLang): object
    {
        if (!in_array($fileLang,config('app.languages_files')))
            return redirect(route('admin.index.translations'))
                ->with(['error' => __('dashboard.file_translation_not_founded')]);
        return view('admin.translation.edit',['content' => $this->getTranslation($fileLang)]);

    }

    public function getTranslation(string $fileLang): array
    {
        return $this->getFileContent($this->getFilePathByName($fileLang));
    }

    private function getFileContent(string $pathFile): array
    {
        return File::getRequire($pathFile);
    }

    private function getFilePathByName(string $fileLang): string
    {
        return resource_path("lang/$fileLang/dashboard.php");
    }

    public function update(Request $request,$fileLang): object
    {
        file_put_contents($this->getFilePathByName($fileLang), $this->configureContentToSave($request));
        return redirect(route('admin.index.translations'))->with(['success' => __('dashboard.operation_done_successfully')]);
    }

    private function configureContentToSave(object $request): string
    {
        $content = '<?php return [' . PHP_EOL;
        foreach ($request->except('_token') as $Key => $Value) {
            $content .= "'$Key' => '$Value'," . PHP_EOL;
        }
        $content .= "];";
        return $content;
    }
}
