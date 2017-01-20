<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Api;

/**
 * Rule repository interface.
 *
 * @api
 */
interface RuleRepositoryInterface
{
    /**
     * Performs persist operations for a specified rule.
     *
     * @param \MageWare\IpFilter\Api\Data\RuleInterface $rule The rule ID.
     * @return \MageWare\IpFilter\Api\Data\RuleInterface Rule interface.
     */
    public function save(\MageWare\IpFilter\Api\Data\RuleInterface $rule);

    /**
     * Loads a specified rule.
     *
     * @param int $ruleId The rule ID.
     * @return \MageWare\IpFilter\Api\Data\RuleInterface Rule interface.
     */
    public function getById($ruleId);

    /**
     * Lists rules that match specified search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria The search criteria.
     * @return \MageWare\IpFilter\Api\Data\RuleSearchResultsInterface Rule search result interface.
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Deletes a specified rule.
     *
     * @param \MageWare\IpFilter\Api\Data\RuleInterface $rule The rule ID.
     * @return bool
     */
    public function delete(\MageWare\IpFilter\Api\Data\RuleInterface $rule);

    /**
     * Delete rule by ID.
     *
     * @param int $ruleId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($ruleId);
}
