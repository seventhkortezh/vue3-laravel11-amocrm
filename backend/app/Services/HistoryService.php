<?php
namespace App\Services;

use App\Models\History;

class HistoryService
{
    const DEAL_TYPE = 'Deal';
    const CONTACT_TYPE = 'Contact';

    static public function log(string $entityType, int $entityId, string $action, string $result): void
    {
        if( in_array($entityType, [self::DEAL_TYPE, self::CONTACT_TYPE]) ) {
            $history = new History([
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'action' => $action,
                'result' => $result
            ]);

            $history->save();
        }
    }

}
