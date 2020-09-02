<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Low Author
 *
 * @package		ExpressionEngine
 * @category	Plugin
 * @author		Matthew Kirkpatrick
 * @copyright   Copyright (c) 2020, Matthew Kirkpatrick
 * @link		https://github.com/javashakes
 */

// config
include(PATH_THIRD.'low_author/config.php');

return array(
    'name'              => LOW_AUTHOR_NAME,
    'version'           => LOW_AUTHOR_VERSION,
    'author'            => LOW_AUTHOR_AUTHOR,
    'author_url'        => LOW_AUTHOR_AUTHOR_URL,
    'docs_url'          => LOW_AUTHOR_DOCS,
    'description'       => LOW_AUTHOR_DESC,
    'namespace'         => LOW_AUTHOR_NAMESPACE,
    'settings_exist'    => FALSE,
    'fieldtypes'        => array(
                                    LOW_AUTHOR_NAMESPACE => array(
                                        'name'          => LOW_AUTHOR_NAME,
                                        'compatibility' => 'text'
                                )
                            )
);

/* End of file addon.setup.php */
/* Location: /system/expressionengine/third_party/low_author/addon.setup.php */