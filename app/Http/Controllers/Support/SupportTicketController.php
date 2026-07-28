<?php
namespace App\Http\Controllers\Support;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Support\SupportServiceInterface;
use App\Http\Requests\Support\CreateTicketRequest;
use App\Http\Requests\Support\ReplyTicketRequest;
use App\Http\Resources\Support\TicketResource;
use App\Http\Resources\Support\TicketReplyResource;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller {
    public function __construct(protected SupportServiceInterface $supportService) {}
    #[OA\Get(
        path: '/api/support/tickets',
        summary: 'Get list of SupportTickets',
        tags: ['Customer - SupportTicket'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return TicketResource::collection($this->supportService->getUserTickets(Auth::id() ?? 'guest'));
    }
    #[OA\Post(
        path: '/api/support/tickets',
        summary: 'Create/Process SupportTicket (store)',
        tags: ['Customer - SupportTicket'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['subject', 'message'],
                properties: [
            new OA\Property(property: 'subject', type: 'string'),
            new OA\Property(property: 'message', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(CreateTicketRequest $request) {
        $ticket = $this->supportService->createTicket(Auth::id() ?? 'guest', $request->validated());
        return new TicketResource($ticket);
    }
    #[OA\Post(
        path: '/api/support/tickets/{id}/reply',
        summary: 'reply operation',
        tags: ['Customer - SupportTicket'],
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
        $reply = $this->supportService->replyToTicket($id, Auth::id() ?? 'guest', $request->validated(), false);
        return new TicketReplyResource($reply);
    }
}
