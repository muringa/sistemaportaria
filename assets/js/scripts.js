
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $("#entradaGuarda").mask("99:99 h");
    $("#saidaGuarda").mask("99:99 h");
    $("#registraGuarda").validate({
        rules:{
            nomeGuarda:"required",
            rgGuarda:"required",
            entradaGuarda:"required",
            saidaGuarda:"required",
            senhaGuarda:"required",
            confirmaSenhaGuarda:{
                required: "true",
                equalTo:"#senhaGuarda"
            }

        },
        messages:{
            nomeGuarda:{
                required:"Um nome é requerido!"
            },
            rgGuarda:{
                required:"Um RG é requerido!"
            },
            entradaGuarda:{
                required:"Um horário de entrada é requerido!"
            },
            saidaGuarda:{
                required:"Um horário de saída é requerido!"
            },
            senhaGuarda:{
                required:"Uma senha é requerida!"
            },
            confirmaSenhaGuarda:{
                required:"Uma confirmação é requerida",
                equalTo:"As senhas não batem"
            }
        }
    })

    $.backstretch("assets/img/backgrounds/1.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form validation
    */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.registration-form').on('submit', function(e) {
        var cont = 0;
    	$(this).find('input[type="text"], textarea,input[type="password"]').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
                cont++;
    		}
    		else {
    			$(this).removeClass('input-error');
                e.preventDefault();
               
    		}
            if ($(this).attr("id") == "confirmaSenhaGuarda" && $(this).val() != $("#senhaGuarda").val()){
                e.preventDefault();
                $(this).addClass('input-error');
                $("#senhaGuarda").addClass('input-error');
                cont++;
            }
            else{
                $(this).removeClass('input-error');
                e.preventDefault();
             
            }
            
    	});

       if(cont <= 0){
        
    	$(this).ajaxSubmit({
            success:function(){
                alert("Guarda cadastrado com sucesso!!");
            }
        });
    }
    });
    

});
