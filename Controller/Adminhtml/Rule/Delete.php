<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Controller\Adminhtml\Rule;

class Delete extends \MageWare\IpFilter\Controller\Adminhtml\Rule
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $ruleId = $this->getRequest()->getParam('rule_id');
        if ($ruleId) {
            try {
                $rule = $this->_objectManager->create(\MageWare\IpFilter\Model\Rule::class);
                $rule->load($ruleId);
                $rule->delete();
                $this->messageManager->addSuccess(__('You deleted the rule.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['rule_id' => $ruleId]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a rule to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
