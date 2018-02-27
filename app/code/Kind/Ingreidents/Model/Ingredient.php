<?php


namespace Kind\Ingreidents\Model;

use Kind\Ingreidents\Api\Data\IngredientInterface;

class Ingredient extends \Magento\Framework\Model\AbstractModel implements IngredientInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Kind\Ingreidents\Model\ResourceModel\Ingredient');
    }

    /**
     * Get ingredient_id
     * @return string
     */
    public function getIngredientId()
    {
        return $this->getData(self::INGREDIENT_ID);
    }

    /**
     * Set ingredient_id
     * @param string $ingredientId
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setIngredientId($ingredientId)
    {
        return $this->setData(self::INGREDIENT_ID, $ingredientId);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get content
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set content
     * @param string $content
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get images
     * @return string
     */
    public function getImages()
    {
        return $this->getData(self::IMAGES);
    }

    /**
     * Set images
     * @param string $images
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setImages($images)
    {
        return $this->setData(self::IMAGES, $images);
    }

    /**
     * Get images
     * @return string
     */
    public function getProducts()
    {
        return $this->getData(self::PRODUCTS);
    }

    /**
     * Set images
     * @param string $images
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setProducts($products)
    {
        return $this->setData(self::PRODUCTS, $products);
    }

}
