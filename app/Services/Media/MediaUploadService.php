<?php
namespace App\Services\Media;
use App\Contracts\Media\MediaUploadServiceInterface;
use Illuminate\Http\UploadedFile;

class MediaUploadService implements MediaUploadServiceInterface {
    public function uploadImage(UploadedFile $file, string $path): string {
        // Mock S3 upload or local storage
        return 'http://example.com/uploads/' . $file->getClientOriginalName();
    }
}
