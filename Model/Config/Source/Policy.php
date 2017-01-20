<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model\Config\Source;

class Policy implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
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
}
