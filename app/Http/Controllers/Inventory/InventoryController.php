<?php
namespace App\Http\Controllers\Inventory;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Inventory\InventoryServiceInterface;

class InventoryController extends Controller {
    public function __construct(protected InventoryServiceInterface $inventoryService) {}
}
