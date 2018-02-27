<?php


namespace Kind\Ingreidents\Api\Data;

interface IngredientSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Ingredient list.
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Kind\Ingreidents\Api\Data\IngredientInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
