<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Block\Adminhtml\Rule\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('rule_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Rule'));
    }
}
