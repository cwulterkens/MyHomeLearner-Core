<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Learner;
use Authorization\IdentityInterface;

/**
 * Learner policy
 */
class LearnerPolicy
{
    /**
     * Check if $user can add a learner
     */
    public function canAdd(IdentityInterface $user, Learner $learner): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit a learner
     */
    public function canEdit(IdentityInterface $user, Learner $learner): bool
    {
        return $this->isAdmin($user) || $this->isOwner($user, $learner);
    }

    /**
     * Check if $user can graduate a learner
     */
    public function canGraduate(IdentityInterface $user, Learner $learner): bool
    {
        return $this->isAdmin($user) || $this->isOwner($user, $learner);
    }

    /**
     * Check if $user can delete a learner
     */
    public function canDelete(IdentityInterface $user, Learner $learner): bool
    {
        return $this->isAdmin($user) || $this->isOwner($user, $learner);
    }

    /**
     * Check if $user can view a learner
     */
    public function canView(IdentityInterface $user, Learner $learner): bool
    {
        return $this->isAdmin($user) || $this->isOwner($user, $learner);
    }

    /**
     * Check if $user can generate a PDF for a learner
     */
    public function canPdf(IdentityInterface $user, Learner $learner): bool
    {
        return $this->isAdmin($user) || $this->isOwner($user, $learner);
    }

    /**
     * Check ownership of the learner entity
     */
    protected function isOwner(IdentityInterface $user, Learner $learner): bool
    {
        return $learner->user_id === $user->getIdentifier();
    }

    /**
     * Check if the user is an admin
     */
    protected function isAdmin(IdentityInterface $user): bool
    {
        return $user->get('admin') === 1;
    }
}
