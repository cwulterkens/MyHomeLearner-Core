<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\fileType;
use Authorization\IdentityInterface;

/**
 * fileType policy
 */
class fileTypePolicy
{
    /**
     * Check if $user can add fileType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\fileType $fileType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, fileType $fileType)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can edit fileType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\fileType $fileType
     * @return bool
     */
    public function canEdit(IdentityInterface $user, fileType $fileType)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can delete fileType
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\fileType $fileType
     * @return bool
     */
    public function canDelete(IdentityInterface $user, fileType $fileType)
    {
        return $user->admin === 1;
    }

    /**
     * Check if $user can view schoolYear
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\fileType $fileType
     * @return bool
     */
    public function canView(IdentityInterface $user, fileType $fileType)
    {
        return $user->admin === 1;
    }

    public function canIndex(IdentityInterface $user, fileType $fileType)
    {
        return $user->admin === 1;
    }
}
