<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model;

class Config
{
    const XML_PATH_FILTER_ENABLED = 'mageware_ipfilter/filter/enabled';
    const XML_PATH_FILTER_POLICY = 'mageware_ipfilter/filter/policy';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isFilterEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_FILTER_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getFilterPolicy()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FILTER_POLICY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isFilterPolicyDeny()
    {
        return $this->getFilterPolicy() == PolicyInterface::POLICY_DENY;
    }

    /**
     * @return bool
     */
    public function isFilterPolicyAllow()
    {
        return $this->getFilterPolicy() == PolicyInterface::POLICY_ALLOW;
    }
}
