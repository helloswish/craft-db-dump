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
        //check if plugin is installed
        if (!$plugin = Craft::$app->plugins->getPlugin('db-dump')) 
        {
            Craft::error('Could not load DB Dump plugin');
            return false;
        }

        //get settings
        $settings = $plugin->getSettings();

        //get key
        $key = Craft::$app->request->getParam('key') ?? null;

        //verify key
        if (!$key || !$settings->key || $key != $settings->key) 
        {
            Craft::error('Unauthorized key to initiate backup with DB Dump plugin');
            return false;
        }

        //if a source is set
        if (!empty($settings->source)) 
        {
            //delete old backups if required
            $filesDeleted = $this->_deleteOldBackups($settings->revisions,$settings->source);
        }

        //run backup and capture the URL
        $url = Craft::$app->db->backup();

        //if a source is set
        if(!empty($settings->source)) 
        {
        
            //create temporary file
            $tempFolder = Craft::getAlias('@storage').'/runtime/temp';
            $temp = tempnam($tempFolder, 'DB_');

            //copy data from backup into the temporary file
            $data = file_get_contents($url);
            file_put_contents($temp, $data);

            //delete the originally saved backup from storage/backups
            unlink($url);

            //get the backup folder volume object
            $volume = Craft::$app->getVolumes()->getVolumeById($settings->source) ?? null;

            if($volume) 
            {
            
                //set the folder to save the backup
                $folder = Craft::$app->assets->getRootFolderByVolumeId($volume->id) ?? null;

                if($folder)
                {

                    // place the temporary file into designated asset source. User must add
                    // 'extraAllowedFileExtensions'    => 'sql'
                    // to their main config file

                    $asset = new Asset();
                    $asset->tempFilePath = $temp;
                    $asset->filename = basename($url);
                    $asset->newFolderId = $folder->id;
                    $asset->volumeId = $volume->id;
                    $asset->avoidFilenameConflicts = true;
                    $asset->setScenario(Asset::SCENARIO_CREATE);

                    //save the backup to the selected folder
                    Craft::$app->getElements()->saveElement($asset);

                }

            }
        } 
        else
        {
            Craft::error('No backup source was selected for DB Dump plugin');
            return;
        }

        //check if a redirect was posted
        if (Craft::$app->getRequest('redirect')) {
            $this->redirectToPostedUrl();
        }

        Craft::info('DB Dump success! Removed ' . $filesDeleted . ' old backups');
        die('Success. Removed ' . $filesDeleted . ' old backups');
    }

    /**
     * Delete old backups
     *
     * @param int $revisions
     * @return int
     */
    private function _deleteOldBackups($revisions = null,$source = null)
    {
        //if a number is not passed return
        if (!is_numeric($revisions)) {
            return 0;
        }

        //if source is null return
        if (!$source) {
            return 0;
        }

        $volume = Craft::$app->getVolumes()->getVolumeById($source) ?? null;

        //if volume is null return
        if (!$volume) {
            return 0;
        }

        $folder = Craft::$app->assets->getRootFolderByVolumeId($volume->id) ?? null;

        //if folder is null return
        if (!$folder) {
            return 0;
        }

        //get the total # of assets
        $totalAssets = Craft::$app->assets->getTotalAssets(
            array(
                'folderId' => $folder->id
            ));

        // print_r($totalAssets);
        // die();

        //if there are more assets in the folder than the 
        //number of backups we are keeping
        if($totalAssets > $revisions) 
        {

            //get the ids of the assets in the selected folder
            //ordered descending
            $assets = Asset::find()->folderId($folder->id)->orderBy('dateCreated desc')->ids();

            // print_r($assets);
            // die();

            //slice off the assets to delete into array
            $filesToRemove = array_slice($assets, ($revisions - 1));

            // print_r($filesToRemove);
            // die();

            //var
            $deletedCount = 0;

            //loop the assets to delete and delete them
            foreach ($filesToRemove as $file) 
            {
                $deleted = Craft::$app->elements->deleteElementById($file);
                
                //increment the count of deleted files
                if($deleted) 
                {
                    $deletedCount++;
                }   
            }

            return $deletedCount;

        }

        return 0;

    }
}
