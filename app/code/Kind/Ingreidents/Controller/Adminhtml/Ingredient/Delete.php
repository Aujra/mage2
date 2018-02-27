<?php


namespace Kind\Ingreidents\Controller\Adminhtml\Ingredient;

class Delete extends \Kind\Ingreidents\Controller\Adminhtml\Ingredient
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
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('ingredient_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Kind\Ingreidents\Model\Ingredient');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Ingredient.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['ingredient_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Ingredient to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
