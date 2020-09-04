<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Low Author
 *
 * @package     ExpressionEngine
 * @category    Plugin
 * @author      Matthew Kirkpatrick
 * @copyright   Copyright (c) 2020, Matthew Kirkpatrick
 * @link        https://github.com/javashakes
 */

// config
include(PATH_THIRD.'low_author/config.php');

class Low_author_ft extends EE_Fieldtype {

    // --------------------------------------------------------------------
    // PROPERTIES
    // --------------------------------------------------------------------

    /**
     * Fieldtype Info
     *
     * @var        array
     * @access     public
     */
    var $info = array(
        'name'           => LOW_AUTHOR_NAME,
        'version'        => LOW_AUTHOR_VERSION
    );

    /**
     * Package name
     *
     * @var        string
     * @access     protected
     */
    protected $package = LOW_AUTHOR_PACKAGE;

    /**
     * Site id shortcut
     *
     * @var        int
     * @access     protected
     */
    protected $site_id;

    // --------------------------------------------------------------------
    //  METHODS
    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access     public
     * @return     void
     */
    public function __construct()
    {
        parent::__construct();

        $this->site_id = (int) ee()->config->item('site_id');

        ee()->load->add_package_path(PATH_THIRD . $this->package . '/');
    }

    // --------------------------------------------------------------------

    /**
     * Display field in publish form
     *
     * @access     public
     * @param      string    Current value for field
     * @return     string    HTML containing input field
     */
    public function display_field($data)
    {
        // -------------------------------------
        // Check if entry is new or not
        // -------------------------------------
        if (($entry_id = ee()->input->get_post('entry_id')) && is_numeric($entry_id))
        {
            // Get Screen Name from DB if entry is not new
            $query = ee()->db->select('m.screen_name')
                   ->from('members m')
                   ->join('channel_titles t', 'm.member_id = t.author_id')
                   ->where('t.entry_id', $entry_id)
                   ->get();

            $data = $query->row('screen_name');
        }

        // -------------------------------------
        // Return readonly input field with screen_name
        // -------------------------------------
        return sprintf(
            '<input type="text" name="%s" id="field_id_%s" value="%s" disabled="disabled">',
            $this->field_name,
            $this->field_id,
            $data
        );
    }

    /**
     * Make sure the screen name is saved properly
     *
     * @access     public
     * @param      string    Current value for field
     * @return     string    Screen name for author
     */
    public function save($data)
    {
        if ($author = ee()->input->post('author'))
        {
            $query = ee()->db->select('screen_name')
                   ->from('members')
                   ->where('member_id', $author)
                   ->get();
            $data = $query->row('screen_name');
        }
        return $data;
    }

    // --------------------------------------------------------------------

    /**
     * Helper function
     *
     * @param      array
     * @param      string    key of array to use as value
     * @param      string    key of array to use as key (optional)
     * @return     array
     */
    private function _flatten_results($resultset, $val, $key = FALSE)
    {
        $array = array();

        foreach ($resultset AS $row)
        {
            if ($key !== FALSE)
            {
                $array[$row[$key]] = $row[$val];
            }
            else
            {
                $array[] = $row[$val];
            }
        }

        return $array;
    }

}

/* End of file pi.low_author.php */
/* Location: ./system/expressionengine/third_party/low_author/pi.low_author.php */