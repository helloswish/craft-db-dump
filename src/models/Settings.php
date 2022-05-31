<?php
/**
 * DB Dump plugin for Craft CMS 3.x
 *
 * A simple way to perform database backups in Craft CMS 3.
 *
 * @link      https://swishdigital.co
 * @copyright Copyright (c) 2019-2020 Swish Digital
 */

namespace swishdigital\dbdump\models;

use swishdigital\dbdump\DbDump;

use Craft;
use craft\base\Model;

/**
 * @author    Swish Digital
 * @package   DbDump
 * @since     3.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $key;

    public $source;

    public $revisions;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [];
    }
}
