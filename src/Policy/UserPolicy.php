<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use App\Model\Entity\user;
use Authorization\IdentityInterface;

/**
 * user policy
 */
class userPolicy
{
    /**
     * Check if $user can add user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, user $resource)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can edit user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, user $resource)
    {
        return $user->admin === 1 || $this->isOwner($user, $resource);
    }

    /**
     * Check if $user can delete user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, user $resource)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can view user
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\user $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return $user->admin === 1 || $this->isOwner($user, $resource);
    }

    public function canIndex(IdentityInterface $user, User $resource)
    {
        return $user->admin === 1;
    }

    protected function isOwner(IdentityInterface $user, User $resource)
    {
        return $user->id === $resource->id;
    }
}
