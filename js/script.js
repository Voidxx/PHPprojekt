
window.addEventListener("load", kreirajDogadaje);

 function kreirajDogadaje() {

	
        
       
        
        
        
           var pravokutnik = document.getElementById("pravokutnik");
           
           
        
           pravokutnik.addEventListener("click", function (event) {
        this.innerHTML = "Ovo je statistika broja vlakova po izložbi";
        this.style.top = "80vh";
        this.style.left = "20vw";
        this.style.width = "10vw";
        this.style.height = "8vh";

        
        
           pravokutnik.addEventListener("click", function (event) {
        this.innerHTML = "Ovo su trenutno prijavljeni korisnici po izložbama, kliknite na pobjednika za detalje";
        this.style.top = "150vh";
        this.style.left = "20vw";
        this.style.width = "10vw";
        this.style.height = "8vh";
        
        
        
           pravokutnik.addEventListener("click", function (event) {
        this.innerHTML = "Ovo je dokumentacija";
        this.style.top = "195vh";
        this.style.left = "20vw";
        this.style.width = "10vw";
        this.style.height = "8vh";
        
        
        
           pravokutnik.addEventListener("click", function (event) {
        this.innerHTML = "";
        this.style.top = "0px";
        this.style.left = "0px";
        this.style.border = "none";
        this.style.width = "0%";
        this.style.height = "none";
        this.style.color = "none";
        this.style.background = "none";
        
    }, false);
    
    }, false);
        
    }, false);
        
    }, false);
    
















 }



var today = new Date();  
  var expiry = new Date(today.getTime() + 30 * 24 * 3600 * 1000); // plus 30 days
  var form = document.getElementById("prijava");

  function setCookie(name, value){
    document.cookie=name + "=" + escape(value) + "; path=/; expires=" + expiry.toGMTString();
  }

function putCookie(form){
    if(document.getElementById('remember').checked){
   setCookie("Korime", document.prijava.korime.value);
   return true;
    }
    else return false;
  }


function ReadCookie(){

if (document.cookie !== ""){
        cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            cookie = cookies[i].trim().split("=");
            
            if (cookie[0] === 'Korime') {
                document.prijava.korime.value = cookie[1];
                
            }
        }

        

}
}



    var form = document.getElementById("prijava");
    var data_array = prijava;   
    
function input_form()
{
    //NERADI
    $.each(data_array, function(key, value){

        $(form).find('input[name="'+key+'"]').each(function()
        {
            var $this = $(this);
            switch(this.type)
            {
                case 'select-one':
                case 'select-multiple':
                    $this.attr('selected', true);
                    break;
                case 'password':
                case 'text':
                case 'textarea':
                    $this.val(value);
                    break;
                case 'checkbox':
                case 'radio':
                    //
                    if($(this).val() == value)
                    {
                        this.checked = true;
                    }
            }
        });
    });
}


