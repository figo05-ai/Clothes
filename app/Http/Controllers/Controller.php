<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Clothes E-Commerce API',
    description: 'Comprehensive API Documentation for the full e-commerce system (Customer & Admin routes).',
    contact: new OA\Contact(
        name: 'Figo Team',
        email: 'admin@clothes.com'
    )
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Local Development Server'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum',
    description: 'Enter your Bearer token in the format **Bearer <token>**'
)]
abstract class Controller
{
    //
}
