<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Controller\Adminhtml\Rule;

class Edit extends \MageWare\IpFilter\Controller\Adminhtml\Rule
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context, $coreRegistry);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $ruleId = $this->getRequest()->getParam('rule_id');
        $rule = $this->_objectManager->create(\MageWare\IpFilter\Model\Rule::class);
        if ($ruleId) {
            $rule->load($ruleId);
            if (!$rule->getId()) {
                $this->messageManager->addError(__('This rule no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $form = new \Magento\Framework\DataObject($data);
            if (ip2long($form->getAddress())) {
                $rule->setAddressFromIp($form->getAddress());
            }
            $rule->setPolicy($form->getPolicy());
            $rule->setIsActive($form->getIsActive());
            $rule->setComment($form->getComment());
        }
        $this->_coreRegistry->register('ipfilter_rule', $rule);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $ruleId ? __('Edit Rule') : __('New Rule'),
            $ruleId ? __('Edit Rule') : __('New Rule')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Rules'));
        $resultPage->getConfig()->getTitle()->prepend($rule->getId() ? __('Edit Rule') : __('New Rule'));
        return $resultPage;
    }
}
