<?php
namespace App\Services\Media;
use App\Contracts\Media\MediaServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaService implements MediaServiceInterface {
    public function uploadImage(UploadedFile $file, string $path = 'uploads') {
        $storedPath = $file->store($path, 'public');
        return Storage::url($storedPath);
    }
}
