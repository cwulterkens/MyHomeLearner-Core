<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use App\Model\Entity\journal;
use Authorization\IdentityInterface;

/**
 * journal policy
 */
class journalPolicy
{
    /**
     * Check if $user can add journal
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\journal $journal
     * @return bool
     */
    public function canAdd(IdentityInterface $user, journal $journal)
    {
        return true;
    }

    /**
     * Check if $user can edit journal
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\journal $journal
     * @return bool
     */
    public function canEdit(IdentityInterface $user, journal $journal)
    {
        return $user->admin === 1 || $this->isOwner($user, $journal);
    }

    /**
     * Check if $user can delete journal
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\journal $journal
     * @return bool
     */
    public function canDelete(IdentityInterface $user, journal $journal)
    {
        return $user->admin === 1 || $this->isOwner($user, $journal);
    }

    /**
     * Check if $user can view journal
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\journal $journal
     * @return bool
     */
    public function canView(IdentityInterface $user, journal $journal)
    {
        return $user->admin === 1 || $this->isOwner($user, $journal);
    }

    public function canIndex(IdentityInterface $user, journal $journal)
    {
        return $user->admin === 1 || $this->isOwner($user, $journal);
    }

    protected function isOwner(IdentityInterface $user, journal $journal)
    {
        return $journal->user_id === $user->getIdentifier();
    }
}
