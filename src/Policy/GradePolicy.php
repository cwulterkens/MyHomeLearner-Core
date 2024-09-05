<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\grade;
use Authorization\IdentityInterface;

/**
 * grade policy
 */
class gradePolicy
{
    /**
     * Check if $user can add grade
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\grade $grade
     * @return bool
     */
    public function canAdd(IdentityInterface $user, grade $grade)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can edit grade
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\grade $grade
     * @return bool
     */
    public function canEdit(IdentityInterface $user, grade $grade)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can delete grade
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\grade $grade
     * @return bool
     */
    public function canDelete(IdentityInterface $user, grade $grade)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can view grade
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\grade $grade
     * @return bool
     */
    public function canView(IdentityInterface $user, grade $grade)
    {
        return $user->admin === 1;
    }

    public function canIndex(IdentityInterface $user, grade $grade)
    {
        return $user->admin === 1;
    }
}
