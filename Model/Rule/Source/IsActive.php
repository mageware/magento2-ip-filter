<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model\Rule\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => __('Enabled'),
                'value' => \MageWare\IpFilter\Model\StatusInterface::STATUS_ENABLED
            ],
            [
                'label' => __('Disabled'),
                'value' => \MageWare\IpFilter\Model\StatusInterface::STATUS_DISABLED
            ]
        ];
    }

    /**
     * @return int
     */
    public function getDefaultOption()
    {
        return \MageWare\IpFilter\Model\StatusInterface::STATUS_ENABLED;
    }
}
