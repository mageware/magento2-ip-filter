<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Api\Data;

interface RuleInterface
{
    /*
     * Rule ID.
     */
    const RULE_ID = 'rule_id';
    /*
     * Address.
     */
    const ADDRESS = 'address';
    /*
     * Policy.
     */
    const POLICY = 'policy';
    /*
     * Is Active.
     */
    const IS_ACTIVE = 'is_active';
    /*
     * Comment.
     */
    const COMMENT = 'comment';
    /*
     * Created At.
     */
    const CREATED_AT = 'created_at';
    /*
     * Updated At.
     */
    const UPDATED_AT = 'updated_at';

    /**
     * @return int|null Rule ID.
     */
    public function getId();

    /**
     * @return int|null Address.
     */
    public function getAddress();

    /**
     * @return int|null Policy.
     */
    public function getPolicy();

    /**
     * @return bool|null Is Active.
     */
    public function getIsActive();

    /**
     * @return string|null Comment.
     */
    public function getComment();

    /**
     * @return string|null Created-at timestamp.
     */
    public function getCreatedAt();

    /**
     * @return string|null Updated-at timestamp.
     */
    public function getUpdatedAt();

    /**
     * @param int $ruleId
     * @return $this
     */
    public function setId($ruleId);

    /**
     * @param int $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * @param int $policy
     * @return $this
     */
    public function setPolicy($policy);

    /**
     * @param int $isActive
     * @return $this
     */
    public function setIsActive($isActive);

    /**
     * @param string|null $comment
     * @return $this
     */
    public function setComment($comment);

    /**
     * @param string $createdAt timestamp
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @param string $updatedAt timestamp
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
