<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\activity;
use App\Model\Entity\File;
use Authorization\IdentityInterface;

/**
 * activity policy
 */
class activityPolicy
{
    /**
     * Check if $user can add activity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\activity $activity
     * @return bool
     */
    public function canAdd(IdentityInterface $user, activity $activity)
    {
        return true;
    }

    /**
     * Check if $user can edit activity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\activity $activity
     * @return bool
     */
    public function canEdit(IdentityInterface $user, activity $activity)
    {
        return $user->admin === 1 || $this->isOwner($user, $activity);
    }

    /**
     * Check if $user can delete activity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\activity $activity
     * @return bool
     */
    public function canDelete(IdentityInterface $user, activity $activity)
    {
        return $user->admin === 1 || $this->isOwner($user, $activity);
    }

    /**
     * Check if $user can view activity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\activity $activity
     * @return bool
     */
    public function canView(IdentityInterface $user, activity $activity)
    {
        return $user->admin === 1 || $this->isOwner($user, $activity);
    }

    public function canIndex(IdentityInterface $user, activity $activity)
    {
        return $user->admin === 1 || $this->isOwner($user, $activity);
    }

    protected function isOwner(IdentityInterface $user, activity $activity)
    {
        return $activity->user_id === $user->getIdentifier();
    }
}
