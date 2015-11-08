<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Temp Entity.
 *
 * @property int $id
 * @property int $sensor_id
 * @property \App\Model\Entity\Sensor $sensor
 * @property float $temp
 * @property string $description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Temp extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
