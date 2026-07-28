<?php
namespace App\Contracts\Content;
interface AdminContentServiceInterface {
    public function createPage(array $data);
    public function createBanner(array $data);
}
