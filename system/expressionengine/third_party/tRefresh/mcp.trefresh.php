<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TMPLRemould - A Complete Template Management System ReMastering
 *
 * @copyright Copyright (c) 2013, Scott-David Jones <sdjones1985@gmail.com>
 *
 */

 class tRefresh_mcp {
     
     private $siteID;
     
    /**
    * Main Function
    */
     function index(){
         
         //set site id
         $this->siteID = ee()->config->item('site_id');
         //get info
         $vars = array(
            'tmpls' => $this->getTmpl(),
             'snps' => $this->getSnp(),
             'glbs' => $this->getGlbs(),
             'settings' => $this->getSettings(),
         );
         
         //load styles
        ee()->cp->add_to_head(
            '<link rel="stylesheet" type="text/css" href="'.
            URL_THIRD_THEMES.'tmplremould/css/uniform.default.css">'
        );
        ee()->cp->add_to_head(
            '<link rel="stylesheet" type="text/css" href="'.
            URL_THIRD_THEMES.'tmplremould/css/accordion.css">'
        );
        ee()->cp->add_to_head(
            '<link rel="stylesheet" type="text/css" href="'.
            URL_THIRD_THEMES.'tmplremould/css/main.css">'
        );

        //load js
        ee()->cp->add_to_head(
            '<script src="'.
            URL_THIRD_THEMES.'tmplremould/js/tab_ctrl.js"></script>'
        );
        ee()->cp->add_to_head(
            '<script src="'.
            URL_THIRD_THEMES.'tmplremould/js/functions.js"></script>'
        );
        ee()->cp->add_to_head(
            '<script src="'.
            URL_THIRD_THEMES.'tmplremould/js/ace/src-noconflict/ace.js"></script>'
        );
        ee()->cp->add_to_head(
            '<script src="'.
            URL_THIRD_THEMES.'tmplremould/js/loadAce.js"></script>'
        );
         return ee()->load->view('index', $vars, TRUE);
     }
     
     /**
     * Gets Module Settings
     * @return array
     */
     function getSettings(){
        return array();
     }
     
     /**
     * Gets User Accessible Templtate and groups for display
     * @Return Array
     */
     function getTmpl(){
         //get member group
         $mmbrGrp = ee()->session->userdata['group_id'];
         //build sql
         //get template group info
         $tmplSQL = "SELECT G.*
            FROM exp_template_Groups G
            LEFT JOIN exp_template_member_groups m on m.template_group_id = g.group_id and m.group_id = {$mmbrGrp}
            WHERE m.group_id is null
            AND g.site_id = {$this->siteID}";
         //exec sql
         $query = ee()->db->query($tmplSQL);
         $tmplsArray = array();
         //check results
         if ($query->num_rows() > 0) {
             //if we have results build array
                foreach($query->result_array() as $row) {
                    
                    //get temples for the group
                    $tmplTemplsSQL = "SELECT t.*
                        FROM exp_templates t
                        WHERE t.site_id = {$this->siteID}
                        AND t.group_id = {$row['group_id']}";
                    $query2 = ee()->db->query($tmplTemplsSQL);
                    $tmplChildren = array();
                    if($query2->num_rows() > 0){
                        foreach($query2->result_array() as $row2){
                            $tmplChildren[] = $row2;
                        }
                    }
                    
                    //build array
                    $tmplsGroups = array(
                        'tmplG_id' => $row['group_id'],
                        'tmplG_name' => $row['group_name'],
                        'tmplG_default' => $row['is_site_default'],
                        'tmplG_children' => $tmplChildren,
                    );
                    
                    
                    //save
                    $tmplsArray[]=$tmplsGroups;
                    //clear the $snp var
                    unset($tmpls);
                }
          }
         return $tmplsArray;
     }
     
     /**
     * Gets Snippets
     * @return array
     */
     function getSnp(){
        //build SQL query
         $snpSQL = "SELECT * FROM exp_snippets WHERE site_id = {$this->siteID}";
         //run query
         $query = ee()->db->query($snpSQL);
         $snpArray = array();
         //check results
         if ($query->num_rows() > 0) {
             //if we have results build array
                foreach($query->result_array() as $row) {
                    //build array
                    $snp = array(
                        'snp_id' => $row['snippet_id'],
                        'snp_name' => $row['snippet_name'],
                        'snp_contents' => $row['snippet_contents'],
                    );
                    //save
                    $snpArray[]=$snp;
                    //clear the $snp var
                    unset($snp);
                }
          }
         return $snpArray;
     }
     
      /**
     * Gets Globals
     * @return array
     */
     function getGlbs(){
        //build SQL query
         $glbsSQL = "SELECT * FROM exp_global_variables WHERE site_id = {$this->siteID}";
         //run query
         $query = ee()->db->query($glbsSQL);
         $glbsArray = array();
         //check results
         if ($query->num_rows() > 0) {
             //if we have results build array
                foreach($query->result_array() as $row) {
                    //build array
                    $glbs = array(
                        'glbs_id' => $row['variable_id'],
                        'glbs_name' => $row['variable_name'],
                        'glbs_contents' => $row['variable_data'],
                    );
                    //save
                    $glbsArray[]=$glbs;
                    //clear the $glbs var
                    unset($glbs);
                }
        }
         return $glbsArray;
     }
 }
 