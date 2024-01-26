<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfesiResource extends JsonResource
{
    public $status;
    public $messsage;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function __construct($status, $messsage, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->messsage = $messsage;
    }
    public function toArray($request)
    {
        return [
            'success' => $this->status,
            'message' => $this->messsage,
            'data'    => $this->resource
        ];
    }
}
