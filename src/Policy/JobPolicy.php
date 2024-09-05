<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use App\Model\Entity\job;
use Authorization\IdentityInterface;

/**
 * job policy
 */
class jobPolicy
{
    /**
     * Check if $user can add job
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\job $job
     * @return bool
     */
    public function canAdd(IdentityInterface $user, job $job)
    {
        return true;
    }

    /**
     * Check if $user can edit job
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\job $job
     * @return bool
     */
    public function canEdit(IdentityInterface $user, job $job)
    {
        return $user->admin === 1 || $this->isOwner($user, $job);
    }

    /**
     * Check if $user can delete job
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\job $job
     * @return bool
     */
    public function canDelete(IdentityInterface $user, job $job)
    {
        return $user->admin === 1 || $this->isOwner($user, $job);
    }

    /**
     * Check if $user can view job
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\job $job
     * @return bool
     */
    public function canView(IdentityInterface $user, job $job)
    {
        return $user->admin === 1 || $this->isOwner($user, $job);
    }

    public function canIndex(IdentityInterface $user, job $job)
    {
        return $user->admin === 1 || $this->isOwner($user, $job);
    }
    protected function isOwner(IdentityInterface $user, job $job)
    {
        return $job->user_id === $user->getIdentifier();
    }
}
