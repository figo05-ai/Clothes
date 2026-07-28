<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Wallet\AdminWalletServiceInterface;
use App\Http\Requests\Admin\AddWalletCreditRequest;

class WalletController extends Controller {
    public function __construct(protected AdminWalletServiceInterface $adminWalletService) {}
    #[OA\Post(
        path: '/admin/api/wallet/credit',
        summary: 'addCredit operation',
        tags: ['Admin - Wallet'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['user_id', 'amount', 'description'],
                properties: [
            new OA\Property(property: 'user_id', type: 'string'),
            new OA\Property(property: 'amount', type: 'integer'),
            new OA\Property(property: 'description', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function addCredit(AddWalletCreditRequest $request) {
        $this->adminWalletService->addCredit(
            $request->validated('user_id'),
            $request->validated('amount'),
            $request->validated('description')
        );
        return response()->json(['success' => true]);
    }
}
