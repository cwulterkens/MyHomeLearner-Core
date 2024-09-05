<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\course;
use App\Model\Entity\File;
use Authorization\IdentityInterface;

/**
 * course policy
 */
class coursePolicy
{
    /**
     * Check if $user can add course
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\course $course
     * @return bool
     */
    public function canAdd(IdentityInterface $user, course $course)
    {
        return true;
    }

    /**
     * Check if $user can edit course
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\course $course
     * @return bool
     */
    public function canEdit(IdentityInterface $user, course $course)
    {
        return $user->admin === 1 || $this->isOwner($user, $course);
    }

    /**
     * Check if $user can delete course
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\course $course
     * @return bool
     */
    public function canDelete(IdentityInterface $user, course $course)
    {
        return $user->admin === 1 || $this->isOwner($user, $course);
    }

    /**
     * Check if $user can view course
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\course $course
     * @return bool
     */
    public function canView(IdentityInterface $user, course $course)
    {
        return $user->admin === 1 || $this->isOwner($user, $course);
    }

    public function canIndex(IdentityInterface $user, course $course)
    {
        return $user->admin === 1 || $this->isOwner($user, $course);
    }

    protected function isOwner(IdentityInterface $user, course $course)
    {
        return $course->user_id === $user->getIdentifier();
    }
}
