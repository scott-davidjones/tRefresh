var ide_tabs = (function(jQ){
    var tabsChange;
    
    tabsChange = jQ('.ide_tabs').click(function(){
        jQ('.ide_selected').removeClass('ide_selected');
        var cTab = jQ(this).attr('href');
        console.log(cTab);
        jQ('.ide_active').removeClass('ide_active').addClass('ide_deactive');
        jQ(cTab).addClass('ide_active');
        jQ(this).parent().addClass('ide_selected');
    });
})(jQuery);


$('h2.accordion').click(function(){
    $(this).next().slideToggle();
}).next().hide();