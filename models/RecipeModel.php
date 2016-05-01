<?php
/**
 * Recipe plugin for Craft CMS
 *
 * Recipe Model
 *
 * @author    nystudio107
 * @copyright Copyright (c) 2016 nystudio107
 * @link      http://nystudio107.com
 * @package   Recipe
 * @since     1.0.0
 */

namespace Craft;

class RecipeModel extends BaseModel
{
    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'name'                  => array(AttributeType::String, 'default' => ''),
            'description'           => array(AttributeType::String, 'default' => ''),
            'serves'                => array(AttributeType::Number, 'default' => 1),
            'ingredients'           => array(AttributeType::Mixed, 'default' => ''),
            'directions'            => array(AttributeType::Mixed, 'default' => ''),
            'imageId'               => array(AttributeType::Number, 'default' => 0),
            'prepTime'              => array(AttributeType::Number),
            'cookTime'              => array(AttributeType::Number),
            'totalTime'             => array(AttributeType::Number),

            'ratings'               => array(AttributeType::Mixed),

            'servingSize'           => array(AttributeType::String, 'default' => ''),
            'calories'              => array(AttributeType::Number),
            'carbohydrateContent'   => array(AttributeType::Number),
            'cholesterolContent'    => array(AttributeType::Number),
            'fatContent'            => array(AttributeType::Number),
            'fiberContent'          => array(AttributeType::Number),
            'proteinContent'        => array(AttributeType::Number),
            'saturatedFatContent'   => array(AttributeType::Number),
            'sodiumContent'         => array(AttributeType::Number),
            'sugarContent'          => array(AttributeType::Number),
            'transFatContent'       => array(AttributeType::Number),
            'unsaturatedFatContent' => array(AttributeType::Number),
        ));
    }

/* -- Accessors ------------------------------------------------------------ */

    /**
     * @return string the URL to the image
     */
    public function getImageUrl()
    {
        $result = "";
        if (isset($this->imageId))
        {
            $image = craft()->assets->getFileById($this->imageId);
            if ($image)
                $result = $image->url;
        }
        return $result;
    }

    /**
     * @return array of strings for the ingedients
     */
    public function getIngredients($outputUnits="imperial", $serving=0)
    {
        $result = array();
        foreach ($this->ingredients as $row)
        {
            $ingredient = "";
            if ($row['quantity'])
            {

/* -- Multiply the quanity by how many servings we want */

                $multiplier = 1;
                if ($serving > 0)
                    $multiplier = $serving / $this->serves;
                $quantity = $row['quantity'] * $multiplier;

/* -- Do the units conversion */

/* -- Convert imperial units to nice fractions */

                if ($outputUnits == 'imperial')
                    $quanity = $this->convertToFractions($quanity);
                $ingredient .= $quantity;
            }
            if ($row['units'])
            {
                $units = $row['units'];
                if ($quantity == 1)
                    rtrim($units, 's');
                $ingredient .= " " . $units;
            }
            if ($row['ingredient'])
                $ingredient .= " " . $row['ingredient'];
            array_push($result, $ingredient);
        }
        return $result;
    }

    /**
     * @return array of strings for the directions
     */
    public function getDirections()
    {
        $result = array();
        foreach ($this->directions as $row)
        {
            $direction = $row['direction'];
            array_push($result, $direction);
        }
        return $result;
    }

    /**
     * @return string the aggregate rating for this recipe
     */
    public function getAggregateRating()
    {
        $result = 0;
        $total = 0;
        foreach ($this->ratings as $row)
        {
            $result += $row['rating'];
            $total++;
        }
        $result = $result / $total;
        return $result;
    }

    private function convertToFractions($quanity)
    {
        $result = "";

        return $result;
    }
}