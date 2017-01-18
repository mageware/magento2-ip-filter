<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model\ResourceModel;

class Rule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ipfilter_rule', 'rule_id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    public function checkUniqueness(\Magento\Framework\Model\AbstractModel $object)
    {
        $connection = $this->getConnection();
        $select = $connection->select();
        $select->from($this->getMainTable())
            ->where($connection->quoteIdentifier($this->getMainTable() . '.' . $this->getIdFieldName()) . ' <> ?', $object->getId())
            ->where($connection->quoteIdentifier($this->getMainTable() . '.address') . '=?', $object->getAddress())
            ->limit(1);
        return !$connection->fetchRow($select);
    }
}
