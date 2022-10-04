# DB Dump Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 4.1.1 - 2022-10-04
### Added
- Removed $this->redirectToPostedUrl(); unnecessary

## 4.1.0 - 2022-08-01
### Added
- Console command added via pull request

## 4.0.3 - 2022-07-07
### Updated
- Updated schema version to avoid upgrade conflicts

## 4.0.2 - 2022-05-31
### Updated
- Fixed docs and issues URL in composer file

## 4.0.1 - 2022-05-31
### Updated
- Fixed changelog URL for plugin update notices
- Made other small changes for consistency of docs

## 4.0.0 - 2022-05-31
### Updated
- Finalized Craft 4 compatibility

## 4.0.0-alpha - 2022-05-31
### Updated
- Updated to begin Craft 4 compatibility

## 3.0.3 - 2020-04-20
### Fixed
- Updated namespace to comply with psr-4 autoloading standard
- Also updated copyright information

## 3.0.2 - 2020-01-14
### Fixed
- DB Dump now appropriately removes backup files from storage/backups folder
- Changed failing functions from php die command to Craft Error logging

## 3.0.1 - 2019-11-08
### Fixed
- Allowed anonymous access to controller actions

## 3.0.0 - 2019-11-07
### Added
- Initial release
