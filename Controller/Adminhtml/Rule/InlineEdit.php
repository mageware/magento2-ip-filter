<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Controller\Adminhtml\Rule;

class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $ruleId) {
                    /** @var \MageWare\IpFilter\Model\Rule */
                    $rule = $this->_objectManager->create(\MageWare\IpFilter\Model\Rule::class)->load($ruleId);
                    try {
                        $form = new \Magento\Framework\DataObject($postItems[$ruleId]);
                        $rule->setAddressFromIp($form->getAddress());
                        $rule->setPolicy($form->getPolicy());
                        $rule->setIsActive($form->getIsActive());
                        $rule->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithRuleId(
                            $rule,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * @param \MageWare\IpFilter\Model\Rule $rule
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithRuleId(\MageWare\IpFilter\Model\Rule $rule, $errorText)
    {
        return '[Rule ID: ' . $rule->getId() . '] ' . $errorText;
    }
}
