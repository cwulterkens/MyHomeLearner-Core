<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class AuditLogger
{
    public static function log(array $data): bool
    {
        $auditsTable = TableRegistry::getTableLocator()->get('Audits');
        $audit = $auditsTable->newEntity($data);

        return (bool)$auditsTable->save($audit);
    }
}
