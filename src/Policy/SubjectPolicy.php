<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\subject;
use Authorization\IdentityInterface;

/**
 * subject policy
 */
class subjectPolicy
{
    /**
     * Check if $user can add subject
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\subject $subject
     * @return bool
     */
    public function canAdd(IdentityInterface $user, subject $subject)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can edit subject
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\subject $subject
     * @return bool
     */
    public function canEdit(IdentityInterface $user, subject $subject)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can delete subject
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\subject $subject
     * @return bool
     */
    public function canDelete(IdentityInterface $user, subject $subject)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can view subject
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\subject $subject
     * @return bool
     */
    public function canView(IdentityInterface $user, subject $subject)
    {
        return $user->admin === 1;
    }

    public function canIndex(IdentityInterface $user, subject $subject)
    {
        return $user->admin === 1;
    }
}
