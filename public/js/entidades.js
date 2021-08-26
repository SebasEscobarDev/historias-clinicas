$(document).ready(function(){
  console.log('test entidades v=0.1')

  $(document).on('keyup', '#buscar', function(){
    var query = $(this).val();
    buscar_entidades(query);
  });

  $('.recharge').click(function(){
    buscar_entidades('');
    $('#buscar').val('');
    //$('#buscar').removeClass('valid')
    //$('label[for="buscar"]').removeClass('active')
  })

	/*
  *   CRUD PACIENTES
  */
	crud_entidades()
})

function buscar_entidades(query = '')
{
  $.ajax({
    url: window.location.origin+"/buscar-entidad",
    method:'GET',
    data:{query:query},
    dataType:'json',
    success:function(data)
    {
      $('#table-entidades').html(data.table_data);
      //CARGAR BOTONES 
      cargar_botones_ver_editar_desactivar()

      //Cargar ancho de columnas en headers tablas
      header_tablas()

      //tootltip functions
      $('.tooltipped').tooltip({'margin':0});
      //$('#total_records').text(data.total_data);
    }
  })
}

function cargar_botones_ver_editar_desactivar(){
  /***************************                            [6]
   ** BOTON VER PACIENTE **
   ***************************/
  $('.dev-ver-entidad').click(function(){
    ver_entidad( $(this).parent('td').parent('tr').data('id') )
  })

  /******************************                         [4]
   ** VISTA EDITAR PROFESIONAL **
   ******************************/
  $('.dev-edit-entidad').click(function(){
      $('#registrar').hide()
      $('#editar').show()
      editar_entidad( $(this).parent('td').parent('tr').data('id') )
  })


  /**********************************                     [8]
   ** BOTON DESACTIVAR PROFESIONAL **
   **********************************/
  $('.dev-active-entidad').click(function(){
    active_entidad($(this).parent('td').parent('tr').data('id'))
  })
}

function header_tablas(){
  //width table headers
  var n_rows = $('.dev-table-fix table thead tr th').length
  for( var i = 1; i <= n_rows; i++ ){
      $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
  }
}

function crud_entidades(){

  /************                                           [1]
  ** VISTAS **               
  ************/
  $('.vistas').hide()
  $('#list').show()
  $('#editar').hide()

  /******************************************         [2]
  ** BOTON VER LA VISTA REGISTRAR PACIENTE **
  *******************************************/
  $('.btn-registrar').click(function(){
    $('#editar').hide()
    $('#registrar').show()
    $('.vistas').hide()
    $('#'+$(this).data('view')+'').show()
  })

  /*****************************                      [3]
  ** BOTON REGISTRAR PACIENTE **
  ******************************/
  $('#registrar').click(function(){
    create_content(0)
  })

  /***************************                         [5]
   ** BOTON EDITAR PACIENTE **
   ***************************/
  $('#editar').click(function(){
    edit_content( $('#txt_EditEntidad').val() )
  })

  /******************                                  [7]
   ** BOTON VOLVER **
   ******************/
  $('.dev-volver').click(function(){
    limpiar_formulario_entidad()
    active_label_form(0)
    $('.vistas').hide()
    $('#list').show()
  })

  cargar_botones_ver_editar_desactivar()

}

function validar_campos_entidad(entidad){

  var vacio = 0

  //Validar inputs vacios
  for(var clave in entidad) {
    //console.log(clave+": " +entidad[clave])
    if( entidad[clave] == "" || entidad[clave] == 0 ){
      /*STYLE TEXT WITH NO CONTENT*/
      $('#'+clave).css('border-bottom', '1.5px solid red')
      $('#'+clave).parent('.input-field').append('<span class="request-input">*Requerido</span>')
      vacio++;
    }
  }
  return vacio;
}


function limpiar_formulario_entidad(){
	
	$('.frm-registro-entidad input').each(function(){
    $(this).val('')
  })

}

//Funcion para actualizar datos del paciente en la vista
function response_crear_editar_content(result, vista){

  //crear
  if( vista == 1 ){
    if ( $('.list > tr:last-of-type').clone().appendTo('.list') ){
      $('.list > tr:last-of-type').attr('data-id', result.entidad.id)
      var ide = ($('.list > tr').length) + 1
      $('.row-id[data-id="'+result.entidad.id+'"] .id').html($('.list > tr').length)
    }
  }
  limpiar_formulario_entidad()
  $('.vistas').hide()
  $('#list').show()

  //datos actualizados del $entidad
  setTimeout(function(){

    //Listar entidad en fila
    var entidad = '.row-id[data-id="'+result.entidad.id+'"]'

    $(entidad+' .nit_entidad').html(result.entidad.nit_entidad)
    $(entidad+' .nombre_entidad').html(result.entidad.nombre_entidad)
    $(entidad+' .direccion').html(result.entidad.direccion)
    $(entidad+' .telefonos').html(result.entidad.telefonos)
    $(entidad+' .dev-offline-entidad').attr('data-id', result.entidad.id)


    //cargar botones solo al crear
    if( vista == 1 ){
      /***************************                            [6]
       ** BOTON VER entidad **
       ***************************/
      $(entidad+' .dev-ver-entidad').click(function(){
        ver_entidad( $(this).parent('td').parent('tr').data('id') )
      })

      /******************************                         [4]
       ** VISTA EDITAR PROFESIONAL **
       ******************************/
      $(entidad+' .dev-edit-entidad').click(function(){
        $('#registrar').hide()
        $('#editar').show()
        editar_entidad( $(this).parent('td').parent('tr').data('id') )
      })

      /**********************************                     [8]
       ** BOTON DESACTIVAR PROFESIONAL **
       **********************************/
      $(entidad+' .dev-offline-entidad').click(function(){
        active_entidad($(this).parent('td').parent('tr').data('id'))
      })
    }

    var n_rows = $('.dev-table-fix table thead tr th').length
    for( var i = 1; i <= n_rows; i++ ){
      $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
    }
  },300)

}

function ver_entidad(id){

	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});


	$.ajax({
		url: window.location.origin+"/entidades/ver",
		method: 'post',
		data: {
			id : id,
      vista: 1
		},
		success: function(result){

			if ( result.entidad ) {
        
        $('.dev-entidad .card-title').html(result.entidad.nombre_entidad)
        $('.dev-entidad .card-id').html(result.entidad.id)
        $('.dev-entidad .card-nit_entidad').html(result.entidad.nit_entidad)
        $('.dev-entidad .card-nombre_entidad').html(result.entidad.nombre_entidad)
        $('.dev-entidad .card-direccion').html(result.entidad.direccion)
        $('.dev-entidad .card-telefonos').html(result.entidad.telefonos)

        $('#txt_EditEntidad').val(result.entidad.id)
        $('.ver-dev-edit-entidad').click(function(){
          $('#registrar').hide()
          $('#editar').show()
          editar_entidad( $('#txt_EditEntidad').val() )
        })

				$('.vistas').hide()
				$('#show').show()
			}

		},
		error: function(i,o,u){
			console.log('Error al validar')
			console.log(i)
			console.log(o)
			console.log(u)
		}
	});
}

function create_content(prueba){

  // si la variable prueba es igual a 1, las pruebas estan activadas

  if ( prueba == 0 ){

    var entidad = {
      nit_entidad: $('#nit_entidad').val(),
      nombre_entidad: $('#nombre_entidad').val(),
      direccion: $('#direccion').val(),
      telefonos: $('#telefonos').val()
    }

    var valido_campos = validar_campos_entidad( entidad )

    if( valido_campos == 0 ){

  		//enviar contenido ajax al controlador Paciente para insertar
  		$.ajaxSetup({
  		  headers: {
  		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		  }
  		});

  		$.ajax({
  			url: window.location.origin+"/entidades/crear",
  			method: 'post',
  			data: {
  				entidad: entidad
  			},
  			success: function(result){

  				if( result.error ){
  					M.toast({html: result.msg, classes: 'toast-error'});
          }

  				if( result.yes ){
            M.toast({
                html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp;'+result.yes,
                classes: 'toast-success',
                displayLength:5000
            });
            response_crear_editar_content(result, 1)
  				}

  			},
  			error: function(i,o,u){
  				console.log('Error al validar')
  				console.log(i)
  				console.log(o)
  				console.log(u)
  			}
  		});
    }else{
      M.toast({
        html: 'Hay campos sin llenar en el formulario!', 
        classes: 'toast-error'
      });
    }
  }//insert

}

function edit_content(id){

  var entidad = {
    nit_entidad: $('#nit_entidad').val(),
    nombre_entidad: $('#nombre_entidad').val(),
    direccion: $('#direccion').val(),
    telefonos: $('#telefonos').val()
  }

  var valido_campos = validar_campos_entidad( entidad )

  if( valido_campos == 0 ){

    //enviar contenido ajax al controlador paciente para editar
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: window.location.origin+"/entidades/editar",
      method: 'post',
      data: { 
        entidad: entidad,
        id: id
      },
      success: function(result){

        if( result.error ){
          M.toast({html: result.msg, classes: 'toast-error'});
        }

        if( result.yes ){
          M.toast({
            html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp;'+result.yes,
            classes: 'toast-success',
            displayLength:5000
          });
          response_crear_editar_content(result, 2)
        }

      },
      error: function(i,o,u){
        //location.reload();
        console.log('Error al validar')
        console.log(i)
        console.log(o)
        console.log(u)
      }
    });

  }else{
    M.toast({
      html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp; Hay campos sin llenar',
      classes: 'toast-error',
      displayLength:5000
    });
  }

}


function active_label_form(estado){
  if( estado == 1 ){
    $('.frm-registro-entidad label').each(function(){
      $(this).addClass('active')
    })
  }else{
    $('.frm-registro-entidad label').each(function(){
      $(this).removeClass('active')
    })
  }
}

function editar_entidad(id){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$.ajax({
		url: window.location.origin+"/entidades/ver",
		method: 'post',
		data: {
			id : id,
      vista : 2
		},
		success: function(result){

			if ( result.entidad ) {

        $('#nit_entidad').val( result.entidad.nit_entidad )
        $('#nombre_entidad').val( result.entidad.nombre_entidad )
        $('#direccion').val( result.entidad.direccion )
        $('#telefonos').val( result.entidad.telefonos )

				active_label_form(1)

        $('#txt_EditEntidad').val(result.entidad.id)
				
				$('.vistas').hide()
				$('#create').show()
			}

		},
		error: function(i,o,u){
			console.log('Error al validar')
			console.log(i)
			console.log(o)
			console.log(u)
		}
  });
}

function active_entidad(id){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: window.location.origin+"/entidades/active",
    method: 'post',
    data: {
      id : id
    },
    success: function(result){
      var str = $('.dev-active-entidad[data-id="'+id+'"]')
      if( result.activo == 0 ){
        str.addClass('offline-user')
        str.children('.material-icons').html("check")
        str.attr({
          'data-tooltip': 'Activar',
        });
      }else{
        str.removeClass('offline-user')
        str.children('.material-icons').html("clear")
        str.attr({
          'data-tooltip': 'Desactivar',
        });
      }
      str.tooltip({'margin':0});

      M.toast({
        html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp;Entidad '+ ( (result.activo==0) ? "Desactivada" : "Activada" ) +' Correctamente!',
        classes: 'toast-success',
        displayLength:5000
      });

    },
    error: function(i,o,u){
      console.log('Error al validar')
      console.log(i)
      console.log(o)
      console.log(u)
    }
  });

}