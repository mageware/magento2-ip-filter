<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Plugin;

use MageWare\IpFilter\Model\PolicyInterface;

class Filter
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;

    /**
     * @var \MageWare\IpFilter\Model\Config
     */
    protected $config;

    /**
     * @var \MageWare\IpFilter\Model\RuleFactory
     */
    protected $ruleFactory;

    /**
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \MageWare\IpFilter\Model\Config $config
     * @param \MageWare\IpFilter\Model\RuleFactory $ruleFactory
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \MageWare\IpFilter\Model\Config $config,
        \MageWare\IpFilter\Model\RuleFactory $ruleFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->config = $config;
        $this->ruleFactory = $ruleFactory;
    }

    /**
     * @param \Magento\Framework\App\FrontControllerInterface $subject
     * @param callable $proceed
     * @param \Magento\Framework\App\RequestInterface $request
     * @return false|\Magento\Framework\App\Response\Http|\Magento\Framework\Controller\ResultInterface
     */
    public function aroundDispatch(
        \Magento\Framework\App\FrontControllerInterface $subject,
        \Closure $proceed,
        \Magento\Framework\App\RequestInterface $request
    ) {
        if (!$this->config->isFilterEnabled()) {
            return $proceed($request);
        }

        $rule = $this->ruleFactory->create();
        $rule->loadByIp($request->getClientIp());
        if ($rule->getId() && $rule->getIsActive()) {
            if ($rule->isPolicyAllow()) {
                $policy = PolicyInterface::POLICY_ALLOW;
            } elseif ($rule->isPolicyDeny()) {
                $policy = PolicyInterface::POLICY_DENY;
            }
        } else {
            if ($this->config->isFilterPolicyDeny()) {
                $policy = PolicyInterface::POLICY_DENY;
            } elseif ($this->config->isFilterPolicyAllow()) {
                $policy = PolicyInterface::POLICY_ALLOW;
            }
        }

        if ($policy == PolicyInterface::POLICY_ALLOW) {
            return $proceed($request);
        } else {
            $resultPage = $this->pageFactory->create(false, ['template' => 'MageWare_IpFilter::forbidden.phtml']);
            $resultPage->getConfig()->getTitle()->set(__('Forbidden'));
            $resultPage->setHttpResponseCode(403);
            return $resultPage;
        }
    }
}
