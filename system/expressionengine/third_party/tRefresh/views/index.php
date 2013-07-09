<div id="ide_tabs_container"> 
    <ul id="ide_tabs">
            <li class="ide_selected"><a href="#ide_templates" class="ide_tabs">Templates</a></li>
            <li ><a href="#ide_snippets" class="ide_tabs">Snippets</a></li>
            <li><a href="#ide_globals" class="ide_tabs">Globals</a></li>
            <li><a href="#ide_settings" class="ide_tabs">Settings</a></li>
    </ul>

</div>

<div id="ide_templates" class="ide_active ide_content">
    <div id="ide_tmpl_left" class="ide_side">
        
        <div class="accordion vertical">
            <?php
            $tmplSideBarHTML = '';
            foreach($tmpls AS $tmpl){
                $default = '';
                
                if($tmpl['tmplG_default'] == 'y'){
                    $default = '*';
                }
                $tmplSideBarHTML .= '<section id="'.$tmpl['tmplG_name'].'">
                <h2>
                    <a href="#'.$tmpl['tmplG_name'].'">'.$default.' '.$tmpl['tmplG_name'].'</a>
                    <span class="optionsGroup">
                        <a class="delete" href="#" data-href="'.$tmpl['tmplG_id'].'">
                            <img src="'.URL_THIRD_THEMES.'tmplremould/images/del.png"
                                width=16px
                                height=16px
                                alt="Delete Template Group"
                                title="Delete Template Group"> 
                        </a>
                        <a class="edit" href="#" data-href="1'.$tmpl['tmplG_id'].'23">
                            <img src="'.URL_THIRD_THEMES.'tmplremould/images/edit.png"
                                width=16px
                                heigt=16px
                                alt="Edit Template Group"
                                title="Edit Template Group">       
                        </a>
                    </span>
                </h2>
                <p><ul>';
                $childhtml = '';
                foreach($tmpl['tmplG_children'] AS $child){
                    $type = '';
                    //check type
                    switch($child['template_type']){
                        case 'css':
                            $type='css';
                            break;
                        case 'js':
                            $type='js';
                            break;
                        case 'xml':
                            $type='xml';
                            break;
                        case 'feed':
                            $type='rss';
                            break;
                        default:
                             $type='html';
                    }
                    //if php allowed then php
                    if($child['allow_php'] == 'y'){
                        $type='php';
                    }
                    
                    
                    $childhtml .= '<li class="ide_'.$type.'" value="'.$child['template_id'].'"> '.$child['template_name'].'
                        <span class="templateOptionsGroup">
                            <a class="delete" href="#" data-href="'.$child['template_id'].'"><img src="'.URL_THIRD_THEMES.'tmplremould/images/del.png"
                                    width=16px
                                    height=16px
                                    alt="Delete Template"
                                    title="Delete Template"></a>
                            <a class="edit" href="#" data-href="'.$child['template_id'].'"><img src="'.URL_THIRD_THEMES.'tmplremould/images/gear.png"
                                    width=16px
                                    heigt=16px
                                    alt="Template Settings"
                                    title="Template Settings"></a>
                        </span>
                    </li>';
                }
                $tmplSideBarHTML .= $childhtml; 
                $tmplSideBarHTML .='</ul></p></section>';
            
            }
            echo $tmplSideBarHTML;
            ?>
        </div>
    </div>
    <div id='ide_tmpl_main' class="ide_code_area">
    </div>
    
    <div class="create_section">
        <div>
            <a href="#newG" class="newG"><img src='<?php echo URL_THIRD_THEMES ?>tmplremould/images/folder.png'
                     width=32px
                     height=32px
                     alt="New Group"
                     title="New Group"></a>
         </div>
        <div>
            <a href="#newT" class="newT"><img src='<?php echo URL_THIRD_THEMES ?>tmplremould/images/file.png'
                     width=32px
                     height=32px
                     alt="New Template"
                     title="New Template"></a>
        </div>
        <div>
            <a href="#tSettings"><img src='<?php echo URL_THIRD_THEMES ?>tmplremould/images/settings.png'
                     width=32px
                     height=32px
                     alt="Global Template Preferences"
                     title="Global Template Preferences"></a>
        </div>
        <div>
            <a href="#tSettings"><img src='<?php echo URL_THIRD_THEMES ?>tmplremould/images/globe.png'
                     width=32px
                     height=32px
                     alt="Template Preferences Manager"
                     title="Template Preferences Manager"></a>
        </div>
    </div>
</div>
