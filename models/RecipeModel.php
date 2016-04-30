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

}