<?php
namespace App\Contracts\Content;
interface ContentServiceInterface {
    public function getActiveBanners();
    public function getPageBySlug(string $slug);
}
