<?php


namespace Kind\Ingreidents\Controller\Adminhtml;

abstract class Ingredient extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Kind_Ingreidents::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Kind'), __('Kind'))
            ->addBreadcrumb(__('Ingredient'), __('Ingredient'));
        return $resultPage;
    }
}
