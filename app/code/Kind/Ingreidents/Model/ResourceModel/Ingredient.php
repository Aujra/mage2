<?php


namespace Kind\Ingreidents\Model\ResourceModel;

class Ingredient extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('kind_ingreidents_ingredient', 'ingredient_id');
    }
}
