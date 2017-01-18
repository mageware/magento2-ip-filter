<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model;

use MageWare\IpFilter\Api\Data\RuleInterface;

class Rule extends \Magento\Framework\Model\AbstractModel implements RuleInterface
{
    /**
     * @var \MageWare\IpFilter\Model\Rule\Validator
     */
    protected $validator;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \MageWare\IpFilter\Model\Rule\Validator $validator
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \MageWare\IpFilter\Model\Rule\Validator $validator,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->validator = $validator;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MageWare\IpFilter\Model\ResourceModel\Rule');
    }

    /**
     * @return \MageWare\IpFilter\Model\Rule\Validator
     */
    protected function _getValidationRulesBeforeSave()
    {
        return $this->validator;
    }

    /**
     * @return bool
     */
    public function checkUniqueness()
    {
        return $this->_getResource()->checkUniqueness($this);
    }

    /**
     * @param int $address
     * @return $this
     */
    public function loadByAddress($address)
    {
        return $this->load($address, 'address');
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function loadByIp($ip)
    {
        return $this->loadByAddress(sprintf('%u', ip2long($ip)));
    }

    /**
     * @return string|null
     */
    public function getIpFromAddress()
    {
        if (!$this->getAddress()) {
            return;
        }
        return long2ip($this->getAddress());
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function setAddressFromIp($ip)
    {
        return $this->setAddress(sprintf('%u', ip2long($ip)));
    }

    /**
     * @return bool
     */
    public function isPolicyDeny()
    {
        return $this->getPolicy() == PolicyInterface::POLICY_DENY;
    }

    /**
     * @return bool
     */
    public function isPolicyAllow()
    {
        return $this->getPolicy() == PolicyInterface::POLICY_ALLOW;
    }

    /**
     * @return int|null Rule ID.
     */
    public function getId()
    {
        return $this->getData(RuleInterface::RULE_ID);
    }

    /**
     * @return int|null Address.
     */
    public function getAddress()
    {
        return $this->getData(RuleInterface::ADDRESS);
    }

    /**
     * @return int|null Policy.
     */
    public function getPolicy()
    {
        return $this->getData(RuleInterface::POLICY);
    }

    /**
     * @return string|null Is Active.
     */
    public function getIsActive()
    {
        return $this->getData(RuleInterface::IS_ACTIVE);
    }

    /**
     * @return string|null Comment.
     */
    public function getComment()
    {
        return $this->getData(RuleInterface::COMMENT);
    }

    /**
     * @return string|null Created-at timestamp.
     */
    public function getCreatedAt()
    {
        return $this->getData(RuleInterface::CREATED_AT);
    }

    /**
     * @return string|null Updated-at timestamp.
     */
    public function getUpdatedAt()
    {
        return $this->getData(RuleInterface::UPDATED_AT);
    }

    /**
     * @param int $ruleId
     * @return $this
     */
    public function setId($ruleId)
    {
        return $this->setData(RuleInterface::RULE_ID, $ruleId);
    }

    /**
     * @param int $address
     * @return $this
     */
    public function setAddress($address)
    {
        return $this->setData(RuleInterface::ADDRESS, $address);
    }

    /**
     * @param int $policy
     * @return $this
     */
    public function setPolicy($policy)
    {
        return $this->setData(RuleInterface::POLICY, $policy);
    }

    /**
     * @param int $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(RuleInterface::IS_ACTIVE, $isActive);
    }

    /**
     * @param string|null $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(RuleInterface::COMMENT, $comment);
    }

    /**
     * @param string $createdAt timestamp
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(RuleInterface::CREATED_AT, $createdAt);
    }

    /**
     * @param string $updatedAt timestamp
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(RuleInterface::UPDATED_AT, $updatedAt);
    }
}
