<?php
declare(strict_types=1);

namespace App\Utility;

use Cake\ORM\Locator\LocatorAwareTrait;

class AuditLogger
{
    use LocatorAwareTrait;

    public static function log(array $data): bool
    {
        $auditsTable = self::getTableLocator()->get('Audits');
        $audit = $auditsTable->newEntity($data);

        return (bool)$auditsTable->save($audit);
    }
}
