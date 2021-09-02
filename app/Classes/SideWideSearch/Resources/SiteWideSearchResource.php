<?php

namespace App\Classes\SideWideSearch\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteWideSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'match' => $this->match,
            'model' => $this->model,
            'view_link' => $this->view_link,
        ];
    }
}
