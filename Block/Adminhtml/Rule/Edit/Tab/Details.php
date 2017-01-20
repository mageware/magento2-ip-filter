<?php
/**
 * See LICENSE.txt for license details.
 */

namespace MageWare\IpFilter\Block\Adminhtml\Rule\Edit\Tab;

class Details extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \MageWare\IpFilter\Model\Rule\Source\Policy
     */
    protected $policy;

    /**
     * @var \MageWare\IpFilter\Model\Rule\Source\IsActive
     */
    protected $status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \MageWare\IpFilter\Model\Rule\Source\Policy
     * @param \MageWare\IpFilter\Model\Rule\Source\IsActive
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \MageWare\IpFilter\Model\Rule\Source\Policy $policy,
        \MageWare\IpFilter\Model\Rule\Source\IsActive $status,
        array $data = []
    ) {
        $this->policy = $policy;
        $this->status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \MageWare\IpFilter\Model\Rule */
        $rule = $this->_coreRegistry->registry('ipfilter_rule');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('rule_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Details')]);

        if ($rule->getId()) {
            $fieldset->addField(
                'rule_id',
                'hidden',
                [
                    'name' => 'rule_id',
                    'value' => $rule->getId()
                ]
            );
        }

        $fieldset->addField(
            'address',
            'text',
            [
                'name' => 'address',
                'label' => __('Address'),
                'title' => __('Address'),
                'required' => true,
                'value' => $rule->getIpFromAddress()
            ]
        );

        $fieldset->addField(
            'policy',
            'select',
            [
                'label' => __('Policy'),
                'title' => __('Policy'),
                'name' => 'policy',
                'required' => true,
                'values' => $this->policy->toOptionArray(),
                'value' => $rule->getPolicy() !== null ? $rule->getPolicy() : $this->policy->getDefaultOption()
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'values' => $this->status->toOptionArray(),
                'value' => $rule->getIsActive() !== null ? $rule->getIsActive() : $this->status->getDefaultOption()
            ]
        );

        $fieldset->addField(
            'comment',
            'textarea',
            [
                'name' => 'comment',
                'label' => __('Comment'),
                'title' => __('Comment'),
                'value' => $rule->getComment()
            ]
        );

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Details');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Details');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
