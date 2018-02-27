<?php
namespace Kind\Ingreidents\Model\Ingredient;


class Products implements \Magento\Framework\Option\ArrayInterface
{
    protected $collectionFactory;
    /**
     * Products constructor.
     */
    public function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }


    public function toOptionArray()
    {
        $productCollection = $this->collectionFactory->create();
        $productCollection->addAttributeToSelect('*');
        foreach ($productCollection as $product) {
            $options[] = [
                'value' => $product->getId(),
                'label' => $product->getName()
            ];
        }
        return $options;
    }
}