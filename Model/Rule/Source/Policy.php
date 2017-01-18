<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model\Rule\Source;

class Policy implements \Magento\Framework\Data\OptionSourceInterface
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
                'label' => __('Allow'),
                'value' => \MageWare\IpFilter\Model\PolicyInterface::POLICY_ALLOW
            ],
            [
                'label' => __('Deny'),
                'value' => \MageWare\IpFilter\Model\PolicyInterface::POLICY_DENY
            ]
        ];
    }

    /**
     * @return int
     */
    public function getDefaultOption()
    {
        return \MageWare\IpFilter\Model\PolicyInterface::POLICY_DENY;
    }
}
