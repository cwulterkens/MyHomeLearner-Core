<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\File;
use App\Model\Entity\notification;
use Authorization\IdentityInterface;

/**
 * notification policy
 */
class notificationPolicy
{
    /**
     * Check if $user can add notification
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\notification $notification
     * @return bool
     */
    public function canAdd(IdentityInterface $user, notification $notification)
    {
        return $user->admin === 1 || $this->isOwner($user, $notification);
    }

    /**
     * Check if $user can edit notification
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\notification $notification
     * @return bool
     */
    public function canEdit(IdentityInterface $user, notification $notification)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can delete notification
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\notification $notification
     * @return bool
     */
    public function canDelete(IdentityInterface $user, notification $notification)
    {
        return $user->admin === 1 || $this->isOwner($user, $notification);
    }

    /**
     * Check if $user can view notification
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\notification $notification
     * @return bool
     */
    public function canView(IdentityInterface $user, notification $notification)
    {
        return $user->admin === 1 || $this->isOwner($user, $notification);
    }

    public function canMarkRead(IdentityInterface $user, notification $notification)
    {
        return $user->admin === 1 || $this->isOwner($user, $notification);
    }

    public function canIndex(IdentityInterface $user, notification $notification)
    {
        return $user->admin === 1 || $this->isOwner($user, $notification);
    }

    protected function isOwner(IdentityInterface $user, notification $notification)
    {
        return $notification->user_id === $user->getIdentifier();
    }
}
