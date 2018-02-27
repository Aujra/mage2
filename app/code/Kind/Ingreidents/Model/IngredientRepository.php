<?php


namespace Kind\Ingreidents\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Kind\Ingreidents\Api\Data\IngredientInterfaceFactory;
use Kind\Ingreidents\Model\ResourceModel\Ingredient as ResourceIngredient;
use Kind\Ingreidents\Api\Data\IngredientSearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Kind\Ingreidents\Model\ResourceModel\Ingredient\CollectionFactory as IngredientCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Kind\Ingreidents\Api\IngredientRepositoryInterface;

class IngredientRepository implements ingredientRepositoryInterface
{

    protected $ingredientCollectionFactory;

    protected $dataObjectProcessor;

    protected $dataIngredientFactory;

    protected $dataObjectHelper;

    protected $searchResultsFactory;

    protected $resource;

    protected $ingredientFactory;

    private $storeManager;


    /**
     * @param ResourceIngredient $resource
     * @param IngredientFactory $ingredientFactory
     * @param IngredientInterfaceFactory $dataIngredientFactory
     * @param IngredientCollectionFactory $ingredientCollectionFactory
     * @param IngredientSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceIngredient $resource,
        IngredientFactory $ingredientFactory,
        IngredientInterfaceFactory $dataIngredientFactory,
        IngredientCollectionFactory $ingredientCollectionFactory,
        IngredientSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->ingredientFactory = $ingredientFactory;
        $this->ingredientCollectionFactory = $ingredientCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataIngredientFactory = $dataIngredientFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Kind\Ingreidents\Api\Data\IngredientInterface $ingredient
    ) {
        /* if (empty($ingredient->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $ingredient->setStoreId($storeId);
        } */
        try {
            $ingredient->getResource()->save($ingredient);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the ingredient: %1',
                $exception->getMessage()
            ));
        }
        return $ingredient;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($ingredientId)
    {
        $ingredient = $this->ingredientFactory->create();
        $ingredient->getResource()->load($ingredient, $ingredientId);
        if (!$ingredient->getId()) {
            throw new NoSuchEntityException(__('Ingredient with id "%1" does not exist.', $ingredientId));
        }
        return $ingredient;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->ingredientCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Kind\Ingreidents\Api\Data\IngredientInterface $ingredient
    ) {
        try {
            $ingredient->getResource()->delete($ingredient);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Ingredient: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($ingredientId)
    {
        return $this->delete($this->getById($ingredientId));
    }
}
