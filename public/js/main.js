document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
        document.querySelector(
          "body").style.visibility = "hidden";
        document.querySelector(
          ".loading").style.visibility = "visible";
        document.querySelector(
          "#loader").style.visibility = "visible";
    } else {
        $("body").addClass("page-loaded");
        //
        setTimeout(function(){document.querySelector(
          ".loading").style.display = "none"}, 300);
        setTimeout(function(){document.querySelector(
          "#loader").style.display = "none"}, 300);
        document.querySelector(
          "body").style.visibility = "visible";
    }
};

var base = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');

$(function(){

    //AOS.init();

})