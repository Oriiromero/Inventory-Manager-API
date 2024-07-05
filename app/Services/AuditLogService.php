<?php

namespace App\Services;
use App\Models\AuditLog;

class AuditLogService {
    public function storeAction($action, $targetTable, $targetId)
    {
        AuditLog::create([
            'user_id' => 1, //change this when user auth is done
             'action' => $action,
            'target_table' => $targetTable,
            'target_id' => $targetId,
        ]);
    }
}