<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Media\MediaServiceInterface;
use App\Http\Requests\Admin\UploadMediaRequest;

class MediaController extends Controller {
    public function __construct(protected MediaServiceInterface $mediaService) {}
    #[OA\Post(
        path: '/admin/api/media/upload',
        summary: 'Create/Process Media (upload)',
        tags: ['Admin - Media'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['file', 'path'],
                properties: [
            new OA\Property(property: 'file', type: 'string'),
            new OA\Property(property: 'path', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function upload(UploadMediaRequest $request) {
        $url = $this->mediaService->uploadImage($request->file('file'), $request->validated('path') ?? 'uploads');
        return response()->json(['success' => true, 'url' => $url]);
    }
}
