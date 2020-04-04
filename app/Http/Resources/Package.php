<?php

namespace App\Http\Resources;

use App\Package as PackageModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Package extends JsonResource
{
    public function __construct($resource)
    {
        $this->allowed_status = associative(PackageModel::$status, 'code', 'display.'.app()->getLocale());
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'amount' => number_format($this->amount, 2),
            'allowed_children' => $this->allowed_children,
            'status' => $this->allowed_status[$this->status],
            'created_at' => $this->created_at->translatedFormat('jS F Y'),
        ];
    }
}
