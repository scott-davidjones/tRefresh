var tmpl = (function(jQ){
    var tmplBase = EE.BASE + "&C=addons_modules&M=show_module_cp&module=tmplremould";
    
    var getTmpl = $('.ide_gif, .ide_png, .ide_jpg, .ide_css, .ide_html, .ide_js, .ide_php, .ide_xml, .ide_rss');
    getTmpl.click(function(){
        var tmplID = $(this).attr('value');
        console.log(tmplID);
    });
    
})(jQuery);;