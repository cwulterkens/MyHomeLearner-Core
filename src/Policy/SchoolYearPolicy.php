<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\schoolYear;
use Authorization\IdentityInterface;

/**
 * schoolYear policy
 */
class schoolYearPolicy
{
    /**
     * Check if $user can add schoolYear
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\schoolYear $schoolYear
     * @return bool
     */
    public function canAdd(IdentityInterface $user, schoolYear $schoolYear)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can edit schoolYear
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\schoolYear $schoolYear
     * @return bool
     */
    public function canEdit(IdentityInterface $user, schoolYear $schoolYear)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can delete schoolYear
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\schoolYear $schoolYear
     * @return bool
     */
    public function canDelete(IdentityInterface $user, schoolYear $schoolYear)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can view schoolYear
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\schoolYear $schoolYear
     * @return bool
     */
    public function canView(IdentityInterface $user, schoolYear $schoolYear)
    {
        return $user->admin === 1;
    }

    public function canIndex(IdentityInterface $user, schoolYear $schoolYear)
    {
        return $user->admin === 1;
    }
}
