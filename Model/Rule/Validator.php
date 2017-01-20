<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Model\Rule;

class Validator extends \Magento\Framework\Validator\AbstractValidator
{
    public function isValid($value)
    {
        $messages = [];
        if (!$value->getAddress()) {
            $messages['invalid_address'] = 'Invalid address.';
        }
        if (!$value->checkUniqueness()) {
            $messages['defined_address'] = 'Address is already defined.';
        }
        $this->_addMessages($messages);
        return empty($messages);
    }
}
