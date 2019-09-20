$(document).ready(function(){  
    $('.borrar_registro').click(function(e){   
        e.preventDefault();   
    var empid = $(this).attr('data-emp-id');
    var parent = $(this).parent("td").parent("tr");   
    bootbox.dialog({
    message: "Estas seguro que quieres borrarlo ?",
    title: "<i class='oi oi-trash'></i> Borrar !",
    buttons: {
        success: {
           label: "No",
           className: "btn btn-success",
           callback: function() {
           $('.bootbox').modal('hide');
          }
        },
    danger: {
      label: "Borrar!",
      className: "btn btn-danger",
      callback: function() {       
       $.ajax({        
     type: 'POST',
     url: 'eliminar.php',
     data: 'empid='+empid        
       })
       .done(function(response){        
     bootbox.alert(response);
     parent.fadeOut('slow');        
       })
       .fail(function(){        
     bootbox.alert('Error....');               
       })              
      }
    }
    }
    });   
    });
    
        $(function($) {
            // Cuando envia desde formulário
            $('#frmLogin').submit(function() {
                // Limpiando los mensajes de error
                $('div.mensagem-erro').html('');
                // Mostrando carga
                $('div.loader').show();
                // Enviando informacion via AJAX
                $(this).ajaxSubmit(function(respuesta) {
                    // Si no hay error mostrar el siguiente archivo
                    if (!respuesta)
                        // Redirecionando para o painel
                        window.location.href = 'PanelControl.php';
                    else
                    {
                        // Encondiendo la carga con hide()
                        $('div.loader').hide();
                        // Exibimos mensaje de error
                        $('div.mensagem-erro').html(respuesta);
                    }
                });
                // Retornando false
                return false;
            });
        });
});