<?php
namespace App\Contracts\Media;
use Illuminate\Http\UploadedFile;
interface MediaServiceInterface {
    public function uploadImage(UploadedFile $file, string $path = 'uploads');
}
