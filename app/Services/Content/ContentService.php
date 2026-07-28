<?php
namespace App\Services\Content;
use App\Contracts\Content\ContentServiceInterface;
use App\Contracts\Content\AdminContentServiceInterface;
use App\Models\Page;
use App\Models\Banner;

class ContentService implements ContentServiceInterface, AdminContentServiceInterface {
    public function getActiveBanners() {
        return Banner::where('is_active', true)->orderBy('order', 'asc')->get();
    }
    public function getPageBySlug(string $slug) {
        return Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
    }
    public function createPage(array $data) {
        return Page::create($data);
    }
    public function createBanner(array $data) {
        return Banner::create($data);
    }
}
