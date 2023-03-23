$(document).ready(function(){

var searchTerms = ["Ne"];

$("a").each(function(index, element){       
    var linkText = $(this).text();        
    var inArray = $.inArray(linkText, searchTerms);        
    if (inArray !== -1)
    {
        $(this).attr("href", "");

    }      
});




            $('#prijava').submit(function(event) {

                var form = document.getElementById("prijava");

                putCookie(form);




            });
            
            
    

            
});




