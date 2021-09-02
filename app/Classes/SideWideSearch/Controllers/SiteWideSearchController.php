<?php

namespace App\Classes\SideWideSearch\Controllers;

use App\Classes\SideWideSearch\Resources\SiteWideSearchResource;
use App\Classes\SideWideSearch\SiteWideSearch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class SiteWideSearchController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        $results = SiteWideSearch::search($request->search);

        return SiteWideSearchResource::collection($results);
    }
}
