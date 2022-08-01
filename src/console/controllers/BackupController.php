<?php
/**
 * DB Dump plugin for Craft CMS 3.x/4.x
 *
 * A simple way to perform database backups in Craft CMS.
 *
 * @link      https://swishdigital.co
 * @copyright Copyright (c) 2019-2022 Swish Digital
 */

namespace swishdigital\dbdump\console\controllers;

use swishdigital\dbdump\DbDump;

use Craft;
use craft\console\Controller;

/**
 * @author    Swish Digital
 * @package   DbDump
 * @since     3.0.0
 */
class BackupController extends Controller
{

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        echo "Running DB Dump backup...\n";
		DbDump::$plugin->DbDumpService->backup();
		echo "Finished DB Dump backup\n";
    }
}
