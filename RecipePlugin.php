<?php
/**
 * Recipe plugin for Craft CMS
 *
 * A recipe fieldtype
 *
 * @author    nystudio107
 * @copyright Copyright (c) 2016 nystudio107
 * @link      http://nystudio107.com
 * @package   Recipe
 * @since     1.0.0
 */

namespace Craft;

class RecipePlugin extends BasePlugin
{
    /**
     * @return mixed
     */
    public function init()
    {
    }

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
    public function getDescription()
    {
        return Craft::t('A comprehensive recipe FieldType for Craft CMS that includes metric/imperial conversion, portion calculation, and JSON-LD microdata support');
    }

    /**
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/nystudio107/recipe/blob/master/README.md';
    }

    /**
     * @return string
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/nystudio107/recipe/master/releases.json';
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.3';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'nystudio107';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://nystudio107.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     */
    public function onBeforeInstall()
    {
    }

    /**
     */
    public function onAfterInstall()
    {

/* -- Show our "Welcome to Recipe" message */

        craft()->request->redirect(UrlHelper::getCpUrl('recipe/welcome'));
    }

    /**
     */
    public function onBeforeUninstall()
    {
    }

    /**
     */
    public function onAfterUninstall()
    {
    }
}