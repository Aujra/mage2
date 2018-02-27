<?php


namespace Kind\Ingreidents\Api\Data;

interface IngredientInterface
{

    const INGREDIENT_ID = 'ingredient_id';
    const NAME = 'name';
    const CONTENT = 'content';
    const IMAGES = 'images';
    const PRODUCTS = 'products';


    /**
     * Get ingredient_id
     * @return string|null
     */
    public function getIngredientId();

    /**
     * Set ingredient_id
     * @param string $ingredient_id
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setIngredientId($ingredientId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setName($name);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setContent($content);

    /**
     * Get images
     * @return string|null
     */
    public function getImages();

    /**
     * Set images
     * @param string $images
     * @return \Kind\Ingreidents\Api\Data\IngredientInterface
     */
    public function setImages($images);

    public function getProducts();
    public function setProducts($products);
}
