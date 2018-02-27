<?php


namespace Kind\Ingreidents\Model\ResourceModel\Ingredient;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Kind\Ingreidents\Model\Ingredient',
            'Kind\Ingreidents\Model\ResourceModel\Ingredient'
        );
    }
}
