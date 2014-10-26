<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Carabiner 1.45 configuration file.
 * CodeIgniter-library for Asset Management
 */
/*
  |--------------------------------------------------------------------------
  | Script Directory
  |--------------------------------------------------------------------------
  |
  | Path to the script directory.  Relative to the CI front controller.
  |
 */

$config['script_dir'] = 'static/js/';


/*
  |--------------------------------------------------------------------------
  | Style Directory
  |--------------------------------------------------------------------------
  |
  | Path to the style directory.  Relative to the CI front controller
  |
 */

$config['style_dir'] = 'static/css/';

/*
  |--------------------------------------------------------------------------
  | Cache Directory
  |--------------------------------------------------------------------------
  |
  | Path to the cache directory. Must be writable. Relative to the CI
  | front controller.
  |
 */

$config['cache_dir'] = 'static/cache/';




/*
 * The following config values are not required.  See Libraries/Carabiner.php
 * for more information.
 */



/*
  |--------------------------------------------------------------------------
  | Base URI
  |--------------------------------------------------------------------------
  |
  |  Base uri of the site, like http://www.example.com/ Defaults to the CI
  |  config value for base_url.
  |
 */

//$config['base_uri'] = 'http://www.example.com/';


/*
  |--------------------------------------------------------------------------
  | Development Flag
  |--------------------------------------------------------------------------
  |
  |  Flags whether your in a development environment or not. Defaults to FALSE.
  |
 */

$config['dev'] = FALSE;


/*
  |--------------------------------------------------------------------------
  | Combine
  |--------------------------------------------------------------------------
  |
  | Flags whether files should be combined. Defaults to TRUE.
  |
 */

$config['combine'] = TRUE;


/*
  |--------------------------------------------------------------------------
  | Minify Javascript
  |--------------------------------------------------------------------------
  |
  | Global flag for whether JS should be minified. Defaults to TRUE.
  |
 */

$config['minify_js'] = FALSE;


/*
  |--------------------------------------------------------------------------
  | Minify CSS
  |--------------------------------------------------------------------------
  |
  | Global flag for whether CSS should be minified. Defaults to TRUE.
  |
 */

$config['minify_css'] = FALSE;

/*
  |--------------------------------------------------------------------------
  | Force cURL
  |--------------------------------------------------------------------------
  |
  | Global flag for whether to force the use of cURL instead of file_get_contents()
  | Defaults to FALSE.
  |
 */

$config['force_curl'] = FALSE;


/*
  |--------------------------------------------------------------------------
  | Predifined Asset Groups
  |--------------------------------------------------------------------------
  |
  | Any groups defined here will automatically be included.  Of course, they
  | won't be displayed unless you explicity display them ( like this: $this->carabiner->display('jquery') )
  | See docs for more.
  |
  | Currently created groups:
  |	> jQuery (latest in 1.xx version)
  |	> jQuery UI (latest in 1.xx version)
  |	> Ext Core (latest in 3.xx version)
  |	> Chrome Frame (latest in 1.xx version)
  |	> Prototype (latest in 1.x.x.x version)
  |	> script.aculo.us (latest in 1.x.x version)
  |	> Mootools (1.xx version)
  |	> Dojo (latest in 1.xx version)
  |	> SWFObject (latest in 2.xx version)
  |	> YUI (latest core JS/CSS in 2.x.x version)
  |
 */

// jQuery (latest, as of 1.xx)
$config['groups']['site'] = array(
    'js' => array(
        array('jquery.min.js'),
        array('jquery-ui.min.js'),
        array('jquery.ui-contextmenu.min.js'),
        array('bootstrap.min.js'),
        array('ace.min.js'),
        array('ace-extra.min.js'),
        array('ace-elements.min.js'),
        array('jquery.jqGrid.min.js'),
        array('grid.locale-ru.js'),
        array('grid.setcolumns.js'),
        array('bootstrap-multiselect.js'),
        array('bootstrap-tag.min.js'),
        array('iris.min.js'),
        array('jquery.gritter.min.js'),
        array('bootstrap-datepicker.js'),
        array('locales/bootstrap-datepicker.ru.js'),
        array('models/structure.js'),
        array('models/settings.js'),
        array('models/app.js')
    ),
    'css' => array(
        array('bootstrap.min.css'),
        array('font-awesome.min.css'),
        array('ace-fonts.css'),
        array('bootstrap-multiselect.css'),
        array('ui.jqgrid.css'),
        array('jquery-ui.min.css'),
        array('searchFilter.css'),
        array('ui.multiselect.css'),
        array('ace.min.css'),
        array('main.css'),
        array('datepicker.css'),
        array('datepicker3.css'),
        array('jquery.gritter.css')
    )
);