<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FilesLearner Entity
 *
 * @property string $file_id
 * @property string $learner_id
 *
 * @property \App\Model\Entity\File $file
 * @property \App\Model\Entity\Learner $learner
 */
class FilesLearner extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'file' => true,
        'learner' => true,
    ];
}
