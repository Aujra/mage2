<?php


namespace Kind\Ingreidents\Controller\Adminhtml\Ingredient;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('ingredient_id');
        
            $model = $this->_objectManager->create('Kind\Ingreidents\Model\Ingredient')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Ingredient no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            var_dump($_FILES);
            $model->setData($data);
            var_dump($model->getData()); die();
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Ingredient.'));
                $this->dataPersistor->clear('kind_ingreidents_ingredient');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['ingredient_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Ingredient.'));
            }
        
            $this->dataPersistor->set('kind_ingreidents_ingredient', $data);
            return $resultRedirect->setPath('*/*/edit', ['ingredient_id' => $this->getRequest()->getParam('ingredient_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
