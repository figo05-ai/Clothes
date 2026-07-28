<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Support\AdminSupportServiceInterface;
use App\Contracts\Support\SupportServiceInterface;
use App\Http\Requests\Admin\UpdateTicketStatusRequest;
use App\Http\Requests\Support\ReplyTicketRequest;
use App\Http\Resources\Support\TicketResource;
use App\Http\Resources\Support\TicketReplyResource;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller {
    public function __construct(
        protected AdminSupportServiceInterface $adminSupportService,
        protected SupportServiceInterface $supportService
    ) {}
    #[OA\Get(
        path: '/admin/api/support/tickets',
        summary: 'Get list of SupportTickets',
        tags: ['Admin - SupportTicket'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return TicketResource::collection($this->adminSupportService->getAllTickets());
    }
    #[OA\Put(
        path: '/admin/api/support/tickets/{id}/status',
        summary: 'Update SupportTicket (updateStatus)',
        tags: ['Admin - SupportTicket'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['status'],
                properties: [
            new OA\Property(property: 'status', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Updated successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function updateStatus(UpdateTicketStatusRequest $request, string $id) {
        $ticket = $this->adminSupportService->updateTicketStatus($id, $request->validated('status'));
        return new TicketResource($ticket);
    }
    #[OA\Post(
        path: '/admin/api/support/tickets/{id}/reply',
        summary: 'reply operation',
        tags: ['Admin - SupportTicket'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['message'],
                properties: [
            new OA\Property(property: 'message', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function reply(ReplyTicketRequest $request, string $id) {
        $reply = $this->supportService->replyToTicket($id, Auth::id() ?? 'admin', $request->validated(), true);
        return new TicketReplyResource($reply);
    }
}
