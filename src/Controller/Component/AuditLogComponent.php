<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class AuditLogComponent extends Component
{
    public function logAudit(array $data): bool
    {
        $auditsTable = TableRegistry::getTableLocator()->get('Audits');
        $audit = $auditsTable->newEntity($data);

        if ($auditsTable->save($audit)) {
            return true;
            $this->Flash->success(__('Audit log success'));
        }

        return false;
        $this->Flash->success(__('Audit log error'));
    }
}
