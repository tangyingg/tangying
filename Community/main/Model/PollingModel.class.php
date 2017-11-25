<?php
/**
 * Powerd by ArPHP.
 *
 * Model.
 *
 * @author ycassnr <ycassnr@gmail.com>
 */

/**
 * Default Model of webapp.
 */
class PollingModel extends ArModel
{
    //表名

    public $tableName='polling';

    //固定写法

    static public function model($class = __CLASS__)
    {
        return parent::model($class);

    }


}