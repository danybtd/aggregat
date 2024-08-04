<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Aggregates\UserAggregate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property UserAggregate $resource
 */
class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getRoot()->id,
            'name' => $this->resource->getRoot()->name,
            'email' => $this->resource->getRoot()->email,
            'created_at' => $this->resource->getRoot()->created_at,
            'updated_at' => $this->resource->getRoot()->updated_at,
        ];
    }
}
