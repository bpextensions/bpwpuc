# BP WP Under Construction
A simple Wordpress plugin showing under construction page for non admins. 

## How to use
- Just enable plugin to show the page or disable to hide.

## How to build from the repository 
If you are a developer tha wants to build extension from this repo you will need Composer installed globally. 
Here are instructions how to build installation package from scratch.

### Requirements
- Composer
- Node

### Build procedure

- Prepare a clean Joomla! installation
- Clone this repo on your installation or cope its contents straight to your Joomla! root directory.
- Run `composer install`
- Run `npm install`
- Run `composer build`
- Your installation zip file should now be read in `/.build` directory.

## Changelog

### v1.1.0

- Added Settings page
- Added translations support.
- Declared minimum PHP version to 7.3
- Declared minimum WordPress version to 6.0

### v1.0.3

- Fix login screen lock down.

### v1.0.0

- Initial release.