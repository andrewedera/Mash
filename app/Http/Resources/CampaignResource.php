<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'domains_count' => $this->domains_count,
            // 'domain' => DomainResource::collection($this->whenLoaded('domainsSorted')),
            // 'server' => new ServerResource($this->whenLoaded('server')),
        ];
    }
}
