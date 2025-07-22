<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SiteService;
use App\Http\Requests\ContactRequest;

class SiteController extends Controller
{
    protected SiteService $siteService;

    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
    }

    public function index()
    {
        [$posts, $filterBannerImages, $count] = $this->siteService->getHomePageData();

        return view('site.index', compact('posts', 'filterBannerImages', 'count'));
    }

    public function checkPost($prev = 0)
    {
        return $this->siteService->checkNewPosts($prev);
    }

    public function contact()
    {
        $filterBannerImages = $this->siteService->getContactBannerImages();

        return view('site.contact', compact('filterBannerImages'));
    }

    public function postContact(ContactRequest $request)
    {
        $this->siteService->sendContactMail($request->validated());

        return back()->with('success', 'Thanks for contacting us!');
    }
}
