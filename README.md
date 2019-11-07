# Dump plugin for Craft CMS 3.x

A simple way to perform database backups in Craft CMS 3.

This Craft 3 version of Dump was ported from the original [Craft 2 version](https://github.com/putyourlightson/craft-dump) with permission by [Ben Croker](https://github.com/putyourlightson).


## Requirements
This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions:

### Automated Installation

Visit the Plugin Store within your Craft project Control Panel. Search for "DB Dump" and select the plugin. Click install.

### Manual Installation

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require swishdigital/db-dump

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for DB Dump.

## Configuring Dump

### Before You Begin

Open your config/general.php file and add

	'extraAllowedFileExtensions' => 'sql'

to either your global settings array, or the array for the environment where you want to perform backups.

### Settings

In the Craft Control Panel, navigate to Settings > Plugins > DB Dump > Settings. Set a key, choose an asset volume with which to store your backups, and set a number of old backups to keep.

## Using Dump

To run a backup, create a GET or a POST request to the DB Dump action URL.

#### Link to the Backup Function in a Twig Template:

	<a href="{{ actionUrl('/db-dump', { key: '" ~ key ~ "' }) }}">Backup Now</a>

#### Trigger a Backup by Visiting a URL in your Browser:

	https://domain.com/index.php?p=actions/db-dump&key=12345

#### Setup a CRON Job to Trigger Backups on a Regular Interval:

Your server CRON syntax may vary. Try either of the examples below. *Ensure you've set (above) the maximum number of backups to keep, unless you potentially want many, many backups.*

	wget https://domain.com/index.php?p=actions/db-dump&key=12345 >/dev/null 2>&1
or

	curl -s -o /dev/null "http://aamgi.loc/actions/db-dump?key=12345678"

## Dump Roadmap

Some things to do, and ideas for potential features:

* Nothing at this time

Brought to you by [Swish Digital](https://helloswish.com)
