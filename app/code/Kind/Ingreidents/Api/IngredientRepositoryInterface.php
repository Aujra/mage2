<?php


namespace Kind\Ingreidents\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface IngredientRepositoryInterface
{


    /**
     * Save Ingredient
     * @param \Kind\Ingreidents\Api\Data\IngredientInterface $ingredient
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Kind\Ingreidents\Api\Data\IngredientInterface $ingredient
    );

    /**
     * Retrieve Ingredient
     * @param string $ingredientId
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($ingredientId);

    /**
     * Retrieve Ingredient matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Kind\Ingreidents\Api\Data\IngredientSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Ingredient
     * @param \Kind\Ingreidents\Api\Data\IngredientInterface $ingredient
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Kind\Ingreidents\Api\Data\IngredientInterface $ingredient
    );

    /**
     * Delete Ingredient by ID
     * @param string $ingredientId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($ingredientId);
}
