<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class RuleRepository implements \MageWare\IpFilter\Api\RuleRepositoryInterface
{
    /**
     * @var \MageWare\IpFilter\Model\ResourceModel\Rule
     */
    protected $resource;

    /**
     * @var \MageWare\IpFilter\Model\RuleFactory
     */
    protected $ruleFactory;

    /**
     * @var \MageWare\IpFilter\Model\ResourceModel\Block\CollectionFactory
     */
    protected $ruleCollectionFactory;

    /**
     * @param \MageWare\IpFilter\Model\RuleFactory $ruleFactory
     * @param \MageWare\IpFilter\Model\ResourceModel\Rule $resource
     * @param \MageWare\IpFilter\Model\ResourceModel\Rule\CollectionFactory $ruleCollectionFactory
     * @param \MageWare\IpFilter\Api\Data\RuleSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        \MageWare\IpFilter\Model\RuleFactory $ruleFactory,
        \MageWare\IpFilter\Model\ResourceModel\Rule $resource,
        \MageWare\IpFilter\Model\ResourceModel\Rule\CollectionFactory $ruleCollectionFactory,
        \MageWare\IpFilter\Api\Data\RuleSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->ruleFactory = $ruleFactory;
        $this->ruleCollectionFactory = $ruleCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Rule data
     *
     * @param \MageWare\IpFilter\Api\Data\RuleInterface $rule
     * @return Rule
     * @throws CouldNotSaveException
     */
    public function save(\MageWare\IpFilter\Api\Data\RuleInterface $rule)
    {
        try {
            $this->resource->save($rule);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $rule;
    }

    /**
     * Load Rule data by given Rule Identity
     *
     * @param string $ruleId
     * @return Rule
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($ruleId)
    {
        $rule = $this->ruleFactory->create();
        $this->resource->load($rule, $ruleId);
        if (!$rule->getId()) {
            throw new NoSuchEntityException(__('Rule with id "%1" does not exist.', $ruleId));
        }
        return $rule;
    }

    /**
     * Load Rule data collection by given search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \MageWare\IpFilter\Model\ResourceModel\Rule\Collection
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->ruleCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * Delete Rule
     *
     * @param \MageWare\IpFilter\Api\Data\RuleInterface $rule
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\MageWare\IpFilter\Api\Data\RuleInterface $rule)
    {
        try {
            $this->resource->delete($rule);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete rule by ID.
     *
     * @param string $ruleId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($ruleId)
    {
        return $this->delete($this->getById($ruleId));
    }
}
