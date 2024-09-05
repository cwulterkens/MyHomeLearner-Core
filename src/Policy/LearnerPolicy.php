<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use App\Model\Entity\Learner;
use Authorization\IdentityInterface;

/**
 * learner policy
 */
class learnerPolicy
{
    /**
     * Check if $user can add learner
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\learner $learner
     * @return bool
     */
    public function canAdd(IdentityInterface $user, learner $learner)
    {
        return true;
    }

    /**
     * Check if $user can edit learner
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\learner $learner
     * @return bool
     */
    public function canEdit(IdentityInterface $user, learner $learner)
    {
        return $user->admin === 1 || $this->isOwner($user, $learner);
    }

   public function canGraduate(IdentityInterface $user, learner $learner)
    {
        return $user->admin === 1 || $this->isOwner($user, $learner);
    }

    /**
     * Check if $user can delete learner
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\learner $learner
     * @return bool
     */
    public function canDelete(IdentityInterface $user, learner $learner)
    {
        return $user->admin === 1 || $this->isOwner($user, $learner);
    }

    /**
     * Check if $user can view learner
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\learner $learner
     * @return bool
     */
    public function canView(IdentityInterface $user, learner $learner)
    {
        return $user->admin === 1 || $this->isOwner($user, $learner);
    }

    public function canIndex(IdentityInterface $user, learner $learner)
    {
        return $user->admin === 1 || $this->isOwner($user, $learner);
    }

    public function canPdf(IdentityInterface $user, learner $learner)
    {
        return $user->admin === 1 || $this->isOwner($user, $learner);
    }

    protected function isOwner(IdentityInterface $user, learner $learner)
    {
        return $learner->user_id === $user->getIdentifier();
    }
}
