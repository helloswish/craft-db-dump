<?php
/**
 * DB Dump plugin for Craft CMS 3.x
 *
 * A simple way to perform database backups in Craft CMS 3.
 *
 * @link      https://helloswish.com
 * @copyright Copyright (c) 2019 Swish Digital
 */

namespace swishdigital\dbdump\variables;

use swishdigital\dbdump\DbDump;

use Craft;

/**
 * @author    Swish Digital
 * @package   DbDump
 * @since     3.0.0
 */
class DbDumpVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }

    //{{ craft.dbDump.getAllSources }}
    public function getAllSources()
    {
        //$allSources = craft()->assetSources->getAllSources();
        $allSources = Craft::$app->volumes->getAllVolumes();

        $sources = array(
            array(
                'label' => 'None',
                'value' => '',
            )
        );

        // Build custom sources array
        foreach ($allSources as $source) {
            $sources[] = array(
                'label' => $source->name,
                'value' => $source->id,
            );
        }

        return $sources;
    }
}
