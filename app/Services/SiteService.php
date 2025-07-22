<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Helper\FileHelper;

class SiteService
{
    public function getHomePageData(): array
    {
        $bannerImages = Post::inRandomOrder()->orderBy('id', 'DESC')->get();
        $filterBannerImages = $this->filterBannerImages($bannerImages);

        $user = Auth::user();
        $posts = [];

        if ($user === null) {
            $posts = Post::where('filter_id', 1)->orderBy('id', 'DESC')->get();
        } elseif ($user->role === 'admin') {
            $posts = Post::getAll();
        } else {
            $userDetail = $user->userDetail;
            $filter = $userDetail?->filter;
            $posts = $filter ? Post::getByFilterAndFollower(false, $filter, $user) : Post::orderBy('id', 'DESC')->get();
        }

        return [$posts, $filterBannerImages, count($posts)];
    }

    public function checkNewPosts(int $prev): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $count = 0;

        if ($user === null) {
            $count = Post::where('filter_id', 1)->count();
        } elseif ($user->role === 'admin') {
            $count = Post::getAll(true);
        } else {
            $userDetail = $user->userDetail;
            $filter = $userDetail?->filter;
            $count = $filter ? Post::getByFilterAndFollower(true, $filter, $user) : Post::count();
        }

        if ($prev === $count) {
            return response()->json(['status' => 'NOK']);
        }

        $posts = match (true) {
            $user === null => Post::where('filter_id', 1)->get(),
            $user->role === 'admin' => Post::getAll(),
            default => Post::getByFilterAndFollower(false, $user->userDetail?->filter, $user)
        };

        $html = view('site._post', compact('posts', 'count'))->render();

        return response()->json([
            'status' => 'OK',
            'html' => $html,
            'count' => $count
        ]);
    }

    public function getContactBannerImages(): array
    {
        $bannerImages = Post::inRandomOrder()->orderBy('id', 'DESC')->get();
        $filterBannerImages = $this->filterBannerImages($bannerImages);

        // Ensure at least two default banners
        for ($i = 0; $i < 2; $i++) {
            if (!isset($filterBannerImages[$i])) {
                $filterBannerImages[$i] = [
                    'image' => 'assets/img/misc/page-header-bg-9.jpg',
                    'username' => 'default',
                    'tagname' => 'default',
                    'description' => 'default',
                ];
            }
        }

        return $filterBannerImages;
    }

    public function sendContactMail(array $data): void
    {
        Mail::to('contact@mail.com')->send(new ContactMail($data));
    }

    private function filterBannerImages($bannerImages): array
    {
        $validImage = ['png', 'jpg', 'jpeg'];
        $filterBannerImages = [];

        foreach ($bannerImages as $bannerImage) {
            $image = FileHelper::url($bannerImage->image);

            if (!@file_get_contents($image)) {
                continue;
            }

            $ext = strtolower(pathinfo($bannerImage->image, PATHINFO_EXTENSION));
            if (!in_array($ext, $validImage)) {
                continue;
            }

            [$width, $height] = getimagesize($image);
            if ($width >= 1920 && $width > $height) {
                $filterBannerImages[] = [
                    'image' => $image,
                    'username' => $bannerImage->user->name,
                    'tagname' => $bannerImage->user->tagname,
                    'description' => $bannerImage->decription
                ];
            }
        }

        if (!isset($filterBannerImages[0])) {
            $filterBannerImages[0] = [
                'image' => 'assets/img/misc/page-header-bg-9.jpg',
                'username' => 'default',
                'tagname' => 'default',
                'description' => 'default',
            ];
        }

        return $filterBannerImages;
    }
}
