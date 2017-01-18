<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Api\Data;

/**
 * Interface for rule search results.
 * @api
 */
interface RuleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get rules list.
     *
     * @return \MageWare\IpFilter\Api\Data\RuleInterface[]
     */
    public function getItems();

    /**
     * Set rules list.
     *
     * @param \MageWare\IpFilter\Api\Data\RuleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
