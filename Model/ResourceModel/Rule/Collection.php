<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model\ResourceModel\Rule;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'rule_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MageWare\IpFilter\Model\Rule', 'MageWare\IpFilter\Model\ResourceModel\Rule');
    }
}
