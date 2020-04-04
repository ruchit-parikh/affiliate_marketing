<?php

namespace App\Http\Resources;

use App\Commission as CommissionModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Commission extends JsonResource
{
    public function __construct($resource)
    {
        $this->allowed_status = associative(CommissionModel::$status, 'code', 'display.'.app()->getLocale());
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
            'type' => $this->type,
            'percentage_amount' => $this->percentage_amount,
            'package' => new PackageCollection($this->package),
            'level' => $this->level,
            'status' => $this->allowed_status[$this->status],
            'created_at' => $this->created_at->translatedFormat('jS F Y'),
        ];
    }
}
