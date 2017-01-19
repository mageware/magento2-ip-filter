<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Controller\Adminhtml\Rule;

class Save extends \MageWare\IpFilter\Controller\Adminhtml\Rule
{
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $ruleId = $this->getRequest()->getParam('rule_id');
            $rule = $this->_objectManager->create(\MageWare\IpFilter\Model\Rule::class)->load($ruleId);
            if (!$rule->getId() && $ruleId) {
                $this->messageManager->addError(__('This rule no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            $form = new \Magento\Framework\DataObject($data);
            $rule->setAddressFromIp($form->getAddress());
            $rule->setPolicy($form->getPolicy());
            $rule->setIsActive($form->getIsActive());
            $rule->setComment($form->getComment());
            try {
                $rule->save();
                $this->messageManager->addSuccess(__('You saved the rule.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['rule_id' => $rule->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_getSession()->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['rule_id' => $this->getRequest()->getParam('rule_id')]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
