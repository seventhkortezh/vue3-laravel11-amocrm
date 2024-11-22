<?php

namespace App\Http\Resources;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin History
 */
class HistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'entity_name' => $this->entityName($this->entity_type),
            'action' => $this->action,
            'result' => $this->result,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
