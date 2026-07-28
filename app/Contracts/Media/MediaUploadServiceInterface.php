<?php
namespace App\Contracts\Media;
use Illuminate\Http\UploadedFile;

interface MediaUploadServiceInterface {
    public function uploadImage(UploadedFile $file, string $path): string;
}
