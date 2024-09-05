<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\honor;
use App\Model\Entity\File;
use Authorization\IdentityInterface;

/**
 * honor policy
 */
class honorPolicy
{
    /**
     * Check if $user can add honor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\honor $honor
     * @return bool
     */
    public function canAdd(IdentityInterface $user, honor $honor)
    {
        return true;
    }

    /**
     * Check if $user can edit honor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\honor $honor
     * @return bool
     */
    public function canEdit(IdentityInterface $user, honor $honor)
    {
        return $user->admin === 1 || $this->isOwner($user, $honor);
    }

    /**
     * Check if $user can delete honor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\honor $honor
     * @return bool
     */
    public function canDelete(IdentityInterface $user, honor $honor)
    {
        return $user->admin === 1 || $this->isOwner($user, $honor);
    }

    /**
     * Check if $user can view honor
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\honor $honor
     * @return bool
     */
    public function canView(IdentityInterface $user, honor $honor)
    {
        return $user->admin === 1 || $this->isOwner($user, $honor);
    }

    public function canIndex(IdentityInterface $user, honor $honor)
    {
        return $user->admin === 1 || $this->isOwner($user, $honor);
    }

    protected function isOwner(IdentityInterface $user, honor $honor)
    {
        return $honor->user_id === $user->getIdentifier();
    }
}
