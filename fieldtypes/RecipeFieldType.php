<?php
/**
 * Recipe plugin for Craft CMS
 *
 * Recipe FieldType
 *
 * @author    nystudio107
 * @copyright Copyright (c) 2016 nystudio107
 * @link      http://nystudio107.com
 * @package   Recipe
 * @since     1.0.0
 */

namespace Craft;

class RecipeFieldType extends BaseFieldType
{
    /**
     * @return mixed
     */
    public function getName()
    {
        return Craft::t('Recipe');
    }

    /**
     * @return mixed
     */
    public function defineContentAttribute()
    {
        return AttributeType::Mixed;
    }

    /**
     * @param string $name
     * @param mixed  $value
     * @return string
     */
    public function getInputHtml($name, $value)
    {
        if (!$value)
            $value = new RecipeModel();

        $id = craft()->templates->formatInputId($name);
        $namespacedId = craft()->templates->namespaceInputId($id);

/* -- Include our Javascript & CSS */

        craft()->templates->includeCssResource('recipe/css/fields/RecipeFieldType.css');
        craft()->templates->includeJsResource('recipe/js/fields/RecipeFieldType.js');

/* -- Variables to pass down to our field.js */

        $jsonVars = array(
            'id' => $id,
            'name' => $name,
            'namespace' => $namespacedId,
            'prefix' => craft()->templates->namespaceInputId(""),
            );

        $jsonVars = json_encode($jsonVars);
        craft()->templates->includeJs("$('#{$namespacedId}').RecipeFieldType(" . $jsonVars . ");");

/* -- Variables to pass down to our rendered template */

        $variables = array(
            'id' => $id,
            'name' => $name,
            'prefix' => craft()->templates->namespaceInputId(""),
            'element' => $this->element,
            'field' => $this->model,
            'values' => $value
            );

        // Whether any assets sources exist
        $sources = craft()->assets->findFolders();
        $variables['assetsSourceExists'] = count($sources);

        // URL to create a new assets source
        $variables['newAssetsSourceUrl'] = UrlHelper::getUrl('settings/assets/sources/new');

        // Set asset ID
        $variables['imageId'] = $value->imageId;

        // Set asset elements
        if ($variables['imageId'])
        {
            if (is_array($variables['imageId']))
            {
                $variables['imageId'] = $variables['imageId'][0];
            }
            $asset = craft()->elements->getElementById($variables['imageId']);
            $variables['elements'] = array($asset);
        }
        else
        {
            $variables['elements'] = array();
        }
        // Set element type
        $variables['elementType'] = craft()->elements->getElementType(ElementType::Asset);
        $variables['assetSources'] = $this->getSettings()->assetSources;

        return craft()->templates->render('recipe/fields/RecipeFieldType.twig', $variables);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function prepValueFromPost($value)
    {
        return $value;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function prepValue($value)
    {
        $value = new RecipeModel($value);
        return $value;
    }


    /**
     * Define our settings
     * @return none
     */
    protected function defineSettings()
        {
            return array(
                'assetSources' => AttributeType::Mixed,
            );
        }

    /**
     * Render the field settings
     * @return none
     */
    public function getSettingsHtml()
    {
        $assetElementType = craft()->elements->getElementType(ElementType::Asset);
        return craft()->templates->render('recipe/fields/RecipeFieldType_Settings', array(
            'assetSources'          => $this->getElementSources($assetElementType),
            'settings'              => $this->getSettings()
        ));
   }


    /**
     * Returns sources avaible to an element type.
     *
     * @access protected
     * @return mixed
     */
    protected function getElementSources($elementType)
    {
        $sources = array();

        foreach ($elementType->getSources() as $key => $source)
        {
            if (!isset($source['heading']))
            {
                $sources[] = array('label' => $source['label'], 'value' => $key);
            }
        }

        return $sources;
    }
}