<?php
/**
 * DB Dump plugin for Craft CMS 3.x/4.x
 *
 * A simple way to perform database backups in Craft CMS.
 *
 * @link      https://swishdigital.co
 * @copyright Copyright (c) 2019-2022 Swish Digital
 */

namespace swishdigital\dbdump\controllers;

use swishdigital\dbdump\DbDump;

use Craft;
use craft\elements\Asset;
use craft\Request;
use craft\web\Controller;

/**
 * @author    Swish Digital
 * @package   DbDump
 * @since     3.0.0
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */

    protected array|int|bool $allowAnonymous = true;



    public function init(): void
    {

        parent::init();

    }

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/dbdump
     *
     * @return mixed
     */
    public function actionIndex()
    {
        DbDump::$plugin->DbDumpService->backup();
    }
}
