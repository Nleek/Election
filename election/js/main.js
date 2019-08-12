function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    /*
     * This function was created by W3Schools.
     * It's purpose is to get a specified cookie's value.
     * */
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}
function get_csrf(){
    /*
     * This function returns the CSRF token for easier future use.
     * */
    return getCookie('csrftoken');
}
function create_csrf(){
    /*
    * This function generates a CSRF token to be used on the site.
    * */
    var current_token = get_csrf();
    if(current_token==""){
        var date = new Date();
        time = date.getTime();
        $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
            var ip = Number(data.ip.toString().replace(/\./g, ''));
            var rand = Math.floor(Math.random() * 10000);
            var value = ((ip * time)+rand) / 10000000;
            setCookie("csrftoken", value, "1");
        });
    }
    return get_csrf();
}
function getUrl(variable){ //Checks the URL for a specified variable and returns it's value.
    //console.log("getUrl");
    try{
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
        }
        return(false);
    }
    catch(err){
        console.log("Error: " +err);
    }
}
function getVars(){
    height = $(window).height();
    width = $(window).width();
    main_height = height - $('header').height();
}
function adjustPage(){
    getVars();
    $('main').height(main_height + "px");
    $('.padding-center').each(function(){
        var me = $(this);
        me.removeAttr("style");
        var padding = me.css("padding");
        var vertCenter = (me.parent().height() - me.outerHeight()) / 2;
        $(this).css({"padding-top":vertCenter+"px","padding-bottom":vertCenter+"px"});
    });
    $('.absolute-center').each(function(){
        var me = $(this);
        me.removeAttr("style");
        var padding = me.css("padding");
        var vertCenter = (me.parent().height() - me.outerHeight()) / 2;
        var horizCenter = (me.parent().width() - me.outerWidth()) / 2;
        me.css({"top":vertCenter+"px","left":horizCenter+"px"});
    });
}