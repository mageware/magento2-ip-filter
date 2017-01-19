<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Ui\Component\Filters\Type;

class Address extends \Magento\Ui\Component\Filters\Type\Input
{
    /**
     * Apply filter
     *
     * @return void
     */
    protected function applyFilter()
    {
        if (isset($this->filterData[$this->getName()])) {
            $value = $this->filterData[$this->getName()];

            if (!empty($value)) {
                $filter = $this->filterBuilder->setConditionType('eq')
                    ->setField($this->getName())
                    ->setValue(sprintf('%u', ip2long($value)))
                    ->create();

                $this->getContext()->getDataProvider()->addFilter($filter);
            }
        }
    }
}
