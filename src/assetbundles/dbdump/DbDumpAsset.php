<?php
/**
 * DB Dump plugin for Craft CMS 3.x
 *
 * A simple way to perform database backups in Craft CMS 3.
 *
 * @link      https://helloswish.com
 * @copyright Copyright (c) 2019 Swish Digital
 */

namespace swishdigital\dbdump\assetbundles\DbDump;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Swish Digital
 * @package   DbDump
 * @since     3.0.0
 */
class DbDumpAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@swishdigital/dbdump/assetbundles/dbdump/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/DbDump.js',
        ];

        $this->css = [
            'css/DbDump.css',
        ];

        parent::init();
    }
}
