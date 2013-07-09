<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TMPLRemould - A Complete Template Management System ReMastering
 *
 * @copyright Copyright (c) 2013, Scott-David Jones <sdjones1985@gmail.com>
 *
 */

class tRefresh_upd {

    var $version = '1.0';
    
    /**
     * installer function 
     *
     * @return bool TRUE
     */
    function install()
    {
        ee()->load->dbforge();
        $data = array(
            'module_name' => 'Tmplremould' ,
            'module_version' => $this->version,
            'has_cp_backend' => 'y',
            'has_publish_fields' => 'n'
        );
        ee()->db->insert('modules', $data);
        return TRUE;
    }
    
    
    /**
     * uninstall function
     *
     * @return bool TRUE
     */
    function uninstall()
    {
        ee()->load->dbforge();
    
        ee()->db->select('module_id');
        $query = ee()->db->get_where('modules', array('module_name' => 'Tmplremould'));
    
        ee()->db->where('module_id', $query->row('module_id'));
        ee()->db->delete('module_member_groups');
    
        ee()->db->where('module_name', 'Tmplremould');
        ee()->db->delete('modules');
    
        return TRUE;
    }
    /**
     * update function
     *
     * @param string current version
     *
     * @return bool FALSE
     */
    function update($current = '')
    {
        return FALSE;
    }


}