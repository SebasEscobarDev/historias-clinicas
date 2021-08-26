$(document).ready(function(){
	console.log('test medicos v=0.2')

	/*
    *   CRUD PROFESIONALES
    */
	crud_profesionales()

  checkbox_permitir_crear_cuenta()

  $(document).on('keyup', '#buscar', function(){
    var query = $(this).val();
    buscar_medicos(query, 'keyup');
  });

  $('.recharge').click(function(){
    buscar_medicos('', 'charge');
    $('#buscar').val('');
    //$('#buscar').removeClass('valid')
    //$('label[for="buscar"]').removeClass('active')
  })
})


function checkbox_permitir_crear_cuenta(){
  $('#vista-usuario').hide()
  $('#cuenta').click(function(){
    if( $(this).hasClass('clicked') ){
      $('#cuenta').removeClass('clicked')
      $('#vista-usuario').hide('fast')
    }else{
      $('#cuenta').addClass('clicked')
      $('#vista-usuario').show('fast')
    }
  })
}

function buscar_medicos(query = '', ide)
{
  console.log( 'se ha buscado desde: '+ide  )
  $.ajax({
    url: window.location.origin+"/buscar-medico",
    method:'GET',
    data:{query:query},
    dataType:'json',
    success:function(data)
    {
      $('#profesionales-medicos').html(data.table_data);
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

function header_tablas(){
  //width table headers
  var n_rows = $('.dev-table-fix table thead tr th').length
  for( var i = 1; i <= n_rows; i++ ){
      $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
  }
}

function cargar_botones_ver_editar_desactivar(){
  /***************************                            [6]
  ** BOTON VER PROFESIONAL **
  ***************************/
  $('.dev-ver-profesional').click(function(){
    ver_usuario( $(this).parent('td').parent('tr').data('id') )
  })

  /******************************                         [4]
   ** VISTA EDITAR PROFESIONAL **
   ******************************/
  $('.dev-edit-profesional').click(function(){
    $('#registrar').hide()
    $('#editar').show()
    editar_usuario($(this).parent('td').parent('tr').data('id'))
  })

  /**********************************                     [8]
   ** BOTON DESACTIVAR PROFESIONAL **
   **********************************/
  $('.dev-offline-profesional').click(function(){
    active_profesional($(this).parent('td').parent('tr').data('id'))
  })
}

function crud_profesionales(){

  /************                                           [1]
   ** VISTAS **               
   ************/
	$('.vistas').hide()
	$('#list').show()
	$('#editar').hide()

  /**********************************************         [2]
   ** BOTON VER LA VISTA REGISTRAR PROFESIONAL **
   **********************************************/
  $('.btn-registrar').click(function(){
    $('#title_check_cuenta').html('Crear')
    $('#cuenta').removeClass('clicked')
    $('#editar, .vistas, #vista-usuario').hide()
    $('#registrar, #ocultar-cuenta, #'+$(this).data('view')+'').show()
  })

  /*********************************                      [3]
   ** BOTON REGISTRAR PROFESIONAL **
   *********************************/
  $('#registrar').click(function(){
    create_content(0)
  })

  /******************                                     [7]
   ** BOTON VOLVER **
   ******************/
  $('.dev-volver').click(function(){
      limpiar_formulario_medicos()
      active_label_form(0)
      $('.vistas').hide()
      $('#list').show()
  })

  $('#editar').click(function(){
    update_content( $('#txt_EditProfesional').val() )
  })

  cargar_botones_ver_editar_desactivar()



}

function validar_campos_medico(){
  var valido_campos = 0
  $('.frm-registro-medico input').each(function(){
    //console.log( 'input[name="'+$(this).attr('name')+'"] = '+$(this).val() )
    if( $(this).val() == 0 || $(this).val() == '' || $(this).val() == null ){
      var ide = $(this).attr('id')
      if( ide == 'user' || ide == 'pass' || ide == 'passconfirm' ){}else{
        $('#'+ide).css('border-bottom', '1.5px solid red')
        $('#'+ide).parent('.input-field').append('<span class="request-input">*Requerido</span>')
        valido_campos = 1
      }
    }
  })
  //console.log( 'retorno inputs valido campos: '+valido_campos )
  $('.frm-registro-medico select').each(function(){
    if( $(this).val() == 0 || $(this).val() == '' || $(this).val() == null ){
      var ide = $(this).attr('id')
      valido_campos = 1
      $('#'+ide).parent('.select-wrapper').children('input').css('border-bottom', '1.5px solid red')
      $('#'+ide).parent('.select-wrapper').append('<span class="request-input">*Requerido</span>')
    }
  })
  //console.log( 'retorno select valido campos: '+valido_campos )

  //validar si se va a crear cuenta
  if( $('#cuenta').hasClass('clicked') ){
    if( $('#user').val() == '' || $('#user').val() == null ){
      $('#user').css('border-bottom', '1.5px solid red')
      $('#user').parent('.input-field').append('<span class="request-input">*Requerido</span>')      
      valido_campos = 1
    }
    if( $('#pass').val() == '' || $('#pass').val() == null ){
      $('#pass').css('border-bottom', '1.5px solid red')
      $('#pass').parent('.input-field').append('<span class="request-input">*Requerido</span>')
      valido_campos = 1
    }
    if( $('#passconfirm').val() == '' || $('#passconfirm').val() == null ){
      $('#passconfirm').css('border-bottom', '1.5px solid red')
      $('#passconfirm').parent('.input-field').append('<span class="request-input">*Requerido</span>')
      valido_campos = 1
      if( $('#pass').val() != $('#passconfirm').val() ){
        $('#pass').val('')
        $('#passconfirm').val('')
        $('#pass, #passconfirm').css('border-bottom', '1.5px solid red')
        $('#pass, #passconfirm').parent('.input-field').append('<span class="request-input">*Requerido</span>')
        valido_campos = 1
        M.toast({html: 'Las contraseñas no coinciden', classes: 'toast-error'});
      }
    }
  }

  //console.log( 'retorno final valido campos: '+valido_campos )

  return valido_campos
}

function datos_del_medico(){
  var medico = {
    nombre : $('#nombre').val(),
    nit : $('#nit').val(),
    direccion : $('#direccion').val(),
    telefono : $('#telefono').val(),
    celular : $('#celular').val(),
    registro_medico : $('#registro_medico').val(),
    horario_consulta : $('#horario_consulta').val(),
    horario_precedimientos : $('#horario_precedimientos').val(),
    horario_cirugias : $('#horario_cirugias').val(),
    cargo : $('#cargo').val(),
    especialidad : $('#especialidad').val(),
    user : $('#user').val(),
    pass : $('#pass').val(),
    passconfirm : $('#passconfirm').val()
  }
  return medico
}

function limpiar_formulario_medicos(){
	//getSelectedValues
	$('.frm-registro-medico input[name="nombre"], '+
		'.frm-registro-medico input[name="nit"], '+
		'.frm-registro-medico input[name="direccion"], '+
		'.frm-registro-medico input[name="telefono"], '+
		'.frm-registro-medico input[name="celular"], '+
		'.frm-registro-medico input[name="registro_medico"], '+
		'.frm-registro-medico input[name="cargo"], '+
		'.frm-registro-medico input[name="user"], '+
		'.frm-registro-medico input[name="pass"], '+
		'.frm-registro-medico input[name="passconfirm"]').val('')

	$('.frm-registro-medico select').each(function(){

		if( $(this).children('option').attr('selected') ){
			$(this).children('option').removeAttr('selected')
		}
		$(this).parent('div.select-wrapper').children('input').val('')

	})

}

//Funcion para actualizar datos del medico en la vista
function response_crear_editar_content(result, vista){

    //crear
    if( vista == 1 ){
      if ( $('.list > tr:last-of-type').clone().appendTo('.list') ){
        $('.list > tr:last-of-type').attr('data-id', result.medico.id)
      }
    }
    limpiar_formulario_medicos()
    $('.vistas').hide()
    $('#list').show()

    var options = ['Medicina General',
                    'Psiquiatra',
                    'Psicologia',
                    'Fonaudiologia',
                    'Trabajo Social',
                    'Nutricionista',
                    'Otras Especialidades']
    var especialidad = options[''+(result.medico.especialidad_profesional-1)+'']

    //datos actualizados del $medico
    setTimeout(function(){

      console.log( 'result_medico_id: '+result.medico.id )

      var medico = '.row-id[data-id="'+result.medico.id+'"]'

      $(medico+' .id').html( result.medico.id )
      $(medico+' .nit').html( result.medico.nit )
      $(medico+' .nombre').html(result.medico.nombre)
      $(medico+' .registro_medico').html(result.medico.registro_medico)
      $(medico+' .cargo').html(result.medico.cargo)
      $(medico+' .especialidad_profesional').html(especialidad)
      $(medico+' .telefono').html(result.medico.telefono)
      $(medico+' .celular').html(result.medico.celular)
      $(medico+' .dev-offline-profesional').attr('data-id', result.medico.id)

      //cargar botones solo al crear
      if( vista == 1 ){
        /***************************                            [6]
         ** BOTON VER PROFESIONAL **
         ***************************/
        $(medico+' .dev-ver-profesional').click(function(){
          ver_usuario( $(this).parent('td').parent('tr').data('id') )
        })

        /******************************                         [4]
         ** VISTA EDITAR PROFESIONAL **
         ******************************/
        $(medico+' .dev-edit-profesional').click(function(){
          $('#registrar').hide()
          $('#editar').show()
          editar_usuario($(this).parent('td').parent('tr').data('id'))
        })

        /**********************************                     [8]
         ** BOTON DESACTIVAR PROFESIONAL **
         **********************************/
        $(medico+' .dev-offline-profesional').click(function(){
          active_profesional($(this).parent('td').parent('tr').data('id'))
        })
      }

      var n_rows = $('.dev-table-fix table thead tr th').length
      for( var i = 1; i <= n_rows; i++ ){
        $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
      }

    },300)

}

function update_content(id){

  console.log( 'ide editando: '+id )

  var valido_campos = validar_campos_medico()

  if( valido_campos == 0 ){

    var medico = datos_del_medico()
		//enviar contenido ajax al controlador MedicoEspecialista para insertar
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

		$.ajax({
			url: window.location.origin+"/medico-especialista/editar",
			method: 'post',
			data: {
				medico: medico,
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
				console.log('Error al validar')
				console.log(i)
				console.log(o)
				console.log(u)
			}
		});

    // insert
	}else{
    M.toast({
      html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp; Hay campos sin llenar',
      classes: 'toast-error',
      displayLength:5000
    });
  }

}

//vista editar
function editar_usuario(id){
  $('.request-input').remove()
  $('input').css('border-bottom', "1px solid gray")
	$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
	});

	$.ajax({
		url: window.location.origin+"/medico-especialista/ver",
		method: 'post',
		data: {
			id : id
		},
		success: function(result){

			if ( result.medico ) {

				function option_selected(obj, value){
          var input
          obj.children('option').each(function(){
            if( $(this).attr('value') == value ){
              input = $(this).html()
            }
          })

          obj.children('option[value="'+value+'"]').attr('selected', 'selected')
          obj.parent('div.select-wrapper').children('input').val(input)
          return
        }

				$('.frm-registro-medico input[name="nombre"]').val(result.medico.nombre)
				$('.frm-registro-medico input[name="nit"]').val(result.medico.nit)
				$('.frm-registro-medico input[name="direccion"]').val(result.medico.direccion)
				$('.frm-registro-medico input[name="telefono"]').val(result.medico.telefono)
				$('.frm-registro-medico input[name="celular"]').val(result.medico.celular)
				$('.frm-registro-medico input[name="registro_medico"]').val(result.medico.registro_medico)
				$('.frm-registro-medico input[name="cargo"]').val(result.medico.cargo)

        //foreach selects
        $('.frm-registro-medico select').each(function(){
          var id = $(this).attr('id')
          if( id == 'horario_consulta' ){
            option_selected( $(this), result.medico.horario_consulta )
          }else if( id == 'horario_precedimientos' ){
            option_selected( $(this), result.medico.horario_procedimientos )
          }else if( id == 'horario_cirugias' ){
            option_selected( $(this), result.medico.horario_cirujias )
          }else if( id == 'especialidad' ){
            option_selected( $(this), result.medico.especialidad_profesional )
          }else{
            console.log('no entra: '+id+'')
          }
        })

				get_correo(result.medico.user_id, 0)

				active_label_form(1)

        if( result.medico.user_id == 2 ){
          $('#ocultar-cuenta').hide()
          $('#vista-usuario').hide()
          $('#cuenta').removeClass('clicked')
        }else{
          $('#ocultar-cuenta').show()
          $('#title_check_cuenta').html('Modificar')
        }

				$('#txt_EditProfesional').val(result.medico.id)

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

function active_label_form(estado){
    var campos = $('.frm-registro-medico label[for="nombre"], '+
    '.frm-registro-medico label[for="nit"], '+
    '.frm-registro-medico label[for="direccion"], '+
    '.frm-registro-medico label[for="telefono"], '+
    '.frm-registro-medico label[for="celular"], '+
    '.frm-registro-medico label[for="registro_medico"], '+
    '.frm-registro-medico label[for="horario_procedimientos"], '+
    '.frm-registro-medico label[for="horario_cirujias"], '+
    '.frm-registro-medico label[for="cargo"], '+
    '.frm-registro-medico label[for="especialidad_profesional"], '+
    '.frm-registro-medico label[for="user"]')
    if( estado == 1 ){
      campos.addClass('active')
    }else{
      campos.removeClass('active')
    }
}

function ver_usuario(id){

	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});


	$.ajax({
		url: window.location.origin+"/medico-especialista/ver",
		method: 'post',
		data: {
			id : id
		},
		success: function(result){

			if ( result.medico ) {
				$('.dev-medico .card-title').html(result.medico.nombre)
				$('.dev-medico .card-nit').html(result.medico.nit)
				$('.dev-medico .card-direccion').html(result.medico.direccion)
				$('.dev-medico .card-telefono').html(result.medico.telefono)
				$('.dev-medico .card-celular').html(result.medico.celular)
				$('.dev-medico .card-registro_medico').html(result.medico.registro_medico)
				$('.dev-medico .card-horario_consulta').html(result.medico.horario_consulta+' min')
				$('.dev-medico .card-horario_procedimientos').html(result.medico.horario_procedimientos+' min')
				$('.dev-medico .card-horario_cirujias').html(result.medico.horario_cirujias+' min')
				$('.dev-medico .card-cargo').html(result.medico.cargo)
				if( result.medico.especialidad_profesional ){
					var options = ['Medicina General',
					'Psiquiatra',
					'Psicologia',
					'Fonaudiologia',
					'Trabajo Social',
					'Nutricionista',
					'Otras Especialidades']
					var especialidad = options[''+(result.medico.especialidad_profesional-1)+'']
				}
				$('.dev-medico .card-especialidad_profesional').html(especialidad)
        
				$('#txt_EditProfesional').val(result.medico.id)
        $('.ver-dev-edit-profesional').click(function(){
          $('#registrar').hide()
          $('#editar').show()
          editar_usuario( $('#txt_EditProfesional').val() )
        })

				get_correo(result.medico.user_id, 1)

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

    var valido_campos = validar_campos_medico()

    if( valido_campos == 0 ){

      var medico = datos_del_medico()

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: window.location.origin+"/medico-especialista/crear",
        method: 'post',
        data: {
          medico: medico
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
    //fin Insert
    }else{
      M.toast({
        html: 'Hay campos sin llenar en el formulario!', 
        classes: 'toast-error'
      });
    }

  }else{

    var contents = []

    var number = Math.floor(100000000 + Math.random() * 900000000);
    var prueba = Math.floor(10 + Math.random() * 90);

    contents[0] = {'id':"nombre", 'value':'Prueba '+prueba}
    contents[1] = {'id':"nit", 'value': number}
    contents[2] = {'id':"direccion", 'value':'CALLE 60 CRA 10 A'}
    contents[3] = {'id':"telefono", 'value':'8785544'}
    contents[4] = {'id':"celular", 'value':'310111111'}
    contents[5] = {'id':"registro_medico", 'value':'1040'}
    contents[6] = {'id':"horario_consulta", 'value':'10'}
    contents[7] = {'id':"horario_precedimientos", 'value':'10'}
    contents[8] = {'id':"horario_cirugias", 'value':'10'}
    contents[9] = {'id':"cargo", 'value':'Cargo'}
    contents[10] = {'id':"especialidad", 'value': '1'}
    var user = $('input#user').val()
    contents[11] = {'id':"user", 'value': user}
    contents[12] = {'id':"pass", 'value': 'admin2018'}
    contents[13] = {'id':"passconfirm", 'value': 'admin2018'}

    var valido_campos = 0;

  }

}

function get_correo(id, card){
  //0 es editar
  //1 es ver
  console.log( 'id-correo: '+id )
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});


	$.ajax({
		url: window.location.origin+"/correo-especialista",
		method: 'get',
		data: {
			id : id
		},
		success: function(result){

      console.log( result )

			if ( result ) {
				if( card == 1 ){
					$('.dev-medico .card-correo').html(result)
				}else if( card  == 0 ){
					$('.frm-registro-medico input[name="user"]').val(result)
				}else{
          console.log('no es nada')
        }
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

function active_profesional(id){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: window.location.origin+"/medico-especialista/active",
    method: 'post',
    data: {
      id : id
    },
    success: function(result){
      console.log( result )
      var str = $('.dev-offline-profesional[data-id="'+id+'"]')
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
        html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp;Medico Especialista '+ ( (result.activo==0) ? "Desactivado" : "Activado" ) +' Correctamente!',
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
