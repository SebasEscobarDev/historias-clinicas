$(document).ready(function(){
  console.log('test pacientes v=0.1')

  var pickers = document.querySelectorAll('.datepicker');

  function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }

  var config = {
    dateFormat: 'Y-m-d',
    allowInput: false,
    enableTime: false,
    firstDayOfWeek: 1,
    locale: {
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        longhand: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],         
      }, 
      months: {
        shorthand: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        longhand: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      },
    },
    onChange: function(selectedDates, dateStr, instance) {
      var edad = getAge(""+dateStr+"")
      $('#edad').val(edad)
      $('#edad').addClass('valid')
      $('label[for="edad"]').addClass('active')
    },
  };

  Array.prototype.forEach.call(pickers, (el) => {
    flatpickr(el, config);
  });

  $(document).on('keyup', '#buscar', function(){
    var query = $(this).val();
    buscar_pacientes(query);
  });

  $('.recharge').click(function(){
    buscar_pacientes('');
    $('#buscar').val('');
    $('#buscar').removeClass('valid')
    $('label[for="buscar"]').removeClass('active')
  })

	/*
  *   CRUD PACIENTES
  */
	crud_pacientes()
})

function buscar_pacientes(query = '')
{
  $.ajax({
    url: window.location.origin+"/buscar-paciente",
    method:'GET',
    data:{query:query,
          vista:'paciente'},
    dataType:'json',
    success:function(data)
    {
      $('#table-pacientes').html(data.table_data);
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
  $('.dev-ver-paciente').click(function(){
    ver_paciente( $(this).parent('td').parent('tr').data('id') )
  })

  /******************************                         [4]
   ** VISTA EDITAR PROFESIONAL **
   ******************************/
  $('.dev-edit-paciente').click(function(){
      $('#registrar').hide()
      $('#editar').show()
      editar_paciente( $(this).parent('td').parent('tr').data('id') )
  })

  /**********************************                     [8]
   ** BOTON DESACTIVAR PROFESIONAL **
   **********************************/
  $('.dev-offline-paciente').click(function(){
      active_profesional($(this).parent('td').parent('tr').data('id'))
  })
}

function header_tablas(){
  //width table headers
  var n_rows = $('.dev-table-fix table thead tr th').length
  for( var i = 1; i <= n_rows; i++ ){
      $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
  }
}

function crud_pacientes(){

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
    edit_content( $('#txt_EditPaciente').val() )
  })

  /******************                                  [7]
   ** BOTON VOLVER **
   ******************/
  $('.dev-volver').click(function(){
    limpiar_formulario_pacientes()
    active_label_form(0)
    $('.vistas').hide()
    $('#list').show()
  })

  cargar_botones_ver_editar_desactivar()

}

function validar_campos_paciente(paciente){

  var vacio = 0

  //Validar inputs vacios
  for(var clave in paciente) {
    //console.log(clave+": " +paciente[clave])
    if( paciente[clave] == "" || paciente[clave] == 0 ){
      //permitir pasar en blanco
      if( clave == "apellido_2" || clave == "telefono" || clave == "celular" ){

      }else{
        if( clave == "identificacion_id" || clave == "sexo" || clave == "clase" || clave == "afiliacion" || clave == "ocupacion" || clave == "depto" || clave == "municipio" ){
          /*STYLE SELECTS WITH NO CONTENT*/
          $('#'+clave).parent('.select-wrapper').children('input').css('border-bottom', '1.5px solid red')
          $('#'+clave).parent('.select-wrapper').append('<span class="request-input">*Requerido</span>')
        }else{
          /*STYLE TEXT WITH NO CONTENT*/
          $('#'+clave).css('border-bottom', '1.5px solid red')
          $('#'+clave).parent('.input-field').append('<span class="request-input">*Requerido</span>')
        }
        vacio++;
      }
    }
  }
  return vacio;
}


function limpiar_formulario_pacientes(){
	
	$('.frm-registro-paciente input').each(function(){
    $(this).val('')
  })

	$('.frm-registro-paciente select').each(function(){

		if( $(this).children('option').attr('selected') ){
			$(this).children('option').removeAttr('selected')
		}

	})

}

//Funcion para actualizar datos del paciente en la vista
function response_crear_editar_content(result, vista){

  //crear
  if( vista == 1 ){
    if ( $('.list > tr:last-of-type').clone().appendTo('.list') ){
      $('.list > tr:last-of-type').attr('data-id', result.paciente.id)
    }
  }
  limpiar_formulario_pacientes()
  $('.vistas').hide()
  $('#list').show()

  //datos actualizados del $paciente
  setTimeout(function(){

    var paciente = '.row-id[data-id="'+result.paciente.id+'"]'

    console.log( result.paciente );

    //Listar paciente en fila
    $(paciente+' .identificacion_id').html(result.paciente.identificacion.id)
    $(paciente+' .name').html(result.paciente.identificacion.name)

    $(paciente+' .documento').html(result.paciente.documento)
    $(paciente+' .nombre_1').html(result.paciente.nombre_1)
    $(paciente+' .nombre_2').html(result.paciente.nombre_2)
    $(paciente+' .apellido_1').html(result.paciente.apellido_1)
    $(paciente+' .apellido_2').html(result.paciente.apellido_2)
    //$(paciente+' .txt-name').html(n1+' '+n2+' '+n3+' '+n4)
    $(paciente+' .edad').html(result.paciente.edad)
    $(paciente+' .sexo').html(result.paciente.sexo)
    $(paciente+' .celular').html(result.paciente.celular)

    $(paciente+' .dev-offline-paciente').attr('data-id', result.paciente.id)


    //cargar botones solo al crear
    if( vista == 1 ){
      /***************************                            [6]
       ** BOTON VER PACIENTE **
       ***************************/
      $(paciente+' .dev-ver-paciente').click(function(){
        ver_paciente( $(this).parent('td').parent('tr').data('id') )
      })

      /******************************                         [4]
       ** VISTA EDITAR PROFESIONAL **
       ******************************/
      $(paciente+' .dev-edit-paciente').click(function(){
        $('#registrar').hide()
        $('#editar').show()
        editar_paciente( $(this).parent('td').parent('tr').data('id') )
      })

      /**********************************                     [8]
       ** BOTON DESACTIVAR PROFESIONAL **
       **********************************/
      $(paciente+' .dev-offline-paciente').click(function(){
        active_profesional($(this).parent('td').parent('tr').data('id'))
      })
    }

    var n_rows = $('.dev-table-fix table thead tr th').length
    for( var i = 1; i <= n_rows; i++ ){
      $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
    }
  },300)

}

function ver_paciente(id){

	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});


	$.ajax({
		url: window.location.origin+"/pacientes/ver",
		method: 'post',
		data: {
			id : id,
      vista: 1
		},
		success: function(result){

			if ( result.paciente ) {
        console.log( result.paciente )
        var nombre = result.paciente.nombre_1+' '+result.paciente.nombre_2+' '+result.paciente.apellido_1+' '+result.paciente.apellido_2
        $('.dev-paciente .card-identificacion_id').html(result.paciente.identificacion.name)
        $('.dev-paciente .card-documento').html(result.paciente.documento)
        $('.dev-paciente .card-title').html(nombre)
        $('.dev-paciente .card-f_nacimiento').html(result.paciente.f_nacimiento)
        $('.dev-paciente .card-edad').html(result.paciente.edad)
        $('.dev-paciente .card-rh').html(result.paciente.rh)
        $('.dev-paciente .card-sexo').html(result.paciente.sexo)
        $('.dev-paciente .card-direccion').html(result.paciente.direccion)
        $('.dev-paciente .card-telefono').html(result.paciente.telefono)
        $('.dev-paciente .card-celular').html(result.paciente.celular)
        $('.dev-paciente .card-correo').html(result.paciente.correo)
        $('.dev-paciente .card-clase').html(result.paciente.clase)
        $('.dev-paciente .card-afiliacion').html(result.paciente.afiliacion)
        $('.dev-paciente .card-ocupacion').html(result.paciente.ocupacion)
        $('.dev-paciente .card-municipio').html(result.paciente.municipio.nombre)
        $('.dev-paciente .card-depto').html(result.paciente.departamento.nombre)

        $('#txt_EditPaciente').val(result.paciente.id)
        $('.ver-dev-edit-paciente').click(function(){
          $('#registrar').hide()
          $('#editar').show()
          editar_paciente( $('#txt_EditPaciente').val() )
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

    var paciente = {
      identificacion_id: $('#identificacion_id').val(),
      documento: $('#documento').val(),
      nombre_1: $('#nombre_1').val(),
      nombre_2: $('#nombre_2').val(),
      apellido_1: $('#apellido_1').val(),
      apellido_2: $('#apellido_2').val(),
      f_nacimiento: $('#f_nacimiento').val(),
      edad: $('#edad').val(),
      rh: $('#rh').val(),
      sexo: $('#sexo').val(),
      direccion: $('#direccion').val(),
      telefono: $('#telefono').val(),
      celular: $('#celular').val(),
      correo: $('#correo').val(),
      clase: $('#clase').val(),
      afiliacion: $('#afiliacion').val(),
      ocupacion: $('#ocupacion').val(),
      departamento_id: $('#depto').val(),
      municipio_id: $('#municipio').val()
    }

    var valido_campos = validar_campos_paciente( paciente )

    if( valido_campos == 0 ){

  		//enviar contenido ajax al controlador Paciente para insertar
  		$.ajaxSetup({
  		  headers: {
  		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		  }
  		});

  		$.ajax({
  			url: window.location.origin+"/pacientes/crear",
  			method: 'post',
  			data: {
  				paciente: paciente
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

  var paciente = {
    identificacion_id: $('#identificacion_id').val(),
    documento: $('#documento').val(),
    nombre_1: $('#nombre_1').val(),
    nombre_2: $('#nombre_2').val(),
    apellido_1: $('#apellido_1').val(),
    apellido_2: $('#apellido_2').val(),
    f_nacimiento: $('#f_nacimiento').val(),
    edad: $('#edad').val(),
    rh: $('#rh').val(),
    sexo: $('#sexo').val(),
    direccion: $('#direccion').val(),
    telefono: $('#telefono').val(),
    celular: $('#celular').val(),
    correo: $('#correo').val(),
    clase: $('#clase').val(),
    afiliacion: $('#afiliacion').val(),
    ocupacion: $('#ocupacion').val(),
    departamento_id: $('#depto').val(),
    municipio_id: $('#municipio').val()
  }

  var valido_campos = validar_campos_paciente( paciente )

  if( valido_campos == 0 ){

    //enviar contenido ajax al controlador paciente para editar
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: window.location.origin+"/pacientes/editar",
      method: 'post',
      data: { 
        paciente: paciente,
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
    var campos = $(''+
        '.frm-registro-paciente label[for="identificacion_id"], '+
        '.frm-registro-paciente label[for="documento"], '+
        '.frm-registro-paciente label[for="nombre_1"], '+
        '.frm-registro-paciente label[for="nombre_2"], '+
        '.frm-registro-paciente label[for="apellido_1"], '+
        '.frm-registro-paciente label[for="apellido_2"], '+
        '.frm-registro-paciente label[for="f_nacimiento"], '+
        '.frm-registro-paciente label[for="edad"], '+
        '.frm-registro-paciente label[for="rh"], '+
        '.frm-registro-paciente label[for="sexo"], '+
        '.frm-registro-paciente label[for="direccion"], '+
        '.frm-registro-paciente label[for="telefono"], '+
        '.frm-registro-paciente label[for="celular"], '+
        '.frm-registro-paciente label[for="correo"], '+
        '.frm-registro-paciente label[for="clase"], '+
        '.frm-registro-paciente label[for="afiliacion"], '+
        '.frm-registro-paciente label[for="ocupacion"], '+
        '.frm-registro-paciente label[for="municipio"], '+
        '.frm-registro-paciente label[for="depto"]')
    if( estado == 1 ){
        campos.addClass('active')
    }else{
        campos.removeClass('active')
    }
}

function editar_paciente(id){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$.ajax({
		url: window.location.origin+"/pacientes/ver",
		method: 'post',
		data: {
			id : id
		},
		success: function(result){

			if ( result.paciente ) {
        console.log( 'respuesta de paciente 2:' )
        console.log( result.paciente )

        function option_selected(obj, value){
          if( obj.attr('id') == 'depto' ){

            $('#municipio option').remove()
            $('#list-municipios option[data-depto="'+value+'"]').each(function(i,obj){
              $(obj).clone().appendTo('#municipio')
            })
            $('#div-municipio').removeClass('hide')
            $('#municipio').formSelect()

          }
          var input
          obj.children('option').each(function(){
            if( $(this).attr('value') == value ){
              input = $(this).html()
            }
          })


          obj.children('option[value="'+value+'"]').attr('selected', 'selected')
          obj.parent('div.select-wrapper').children('input').val(input)
          obj.formSelect()

          return
        }

        $('.frm-registro-paciente input[name="documento"]').val(result.paciente.documento)
        $('.frm-registro-paciente input[name="nombre_1"]').val(result.paciente.nombre_1)
        $('.frm-registro-paciente input[name="nombre_2"]').val(result.paciente.nombre_2)
        $('.frm-registro-paciente input[name="apellido_1"]').val(result.paciente.apellido_1)
        $('.frm-registro-paciente input[name="apellido_2"]').val(result.paciente.apellido_2)
        $('.frm-registro-paciente input[name="f_nacimiento"]').val(result.paciente.f_nacimiento)
        $('.frm-registro-paciente input[name="edad"]').val(result.paciente.edad)
        $('.frm-registro-paciente input[name="rh"]').val(result.paciente.rh)
        $('.frm-registro-paciente input[name="direccion"]').val(result.paciente.direccion)
        $('.frm-registro-paciente input[name="telefono"]').val(result.paciente.telefono)
        $('.frm-registro-paciente input[name="celular"]').val(result.paciente.celular)
        $('.frm-registro-paciente input[name="correo"]').val(result.paciente.correo)

        //foreach selects
        $('.frm-registro-paciente select').each(function(){
          var id = $(this).attr('id')
          if( id == 'identificacion_id' ){
            option_selected( $(this), result.paciente.identificacion.id )
          }else if( id == 'sexo' ){
            option_selected( $(this), result.paciente.sexo )
          }else if( id == 'clase' ){
            option_selected( $(this), result.paciente.clase )
          }else if( id == 'afiliacion' ){
            option_selected( $(this), result.paciente.afiliacion )
          }else if( id == 'ocupacion' ){
            option_selected( $(this), result.paciente.ocupacion )
          }else if( id == 'depto' ){
            option_selected( $(this), result.paciente.departamento.id )
          }else if( id == 'municipio' ){
            option_selected( $(this), result.paciente.municipio.id )
          }else{
            console.log('no entra: '+id+'')
          }
        })

				active_label_form(1)

        $('#txt_EditPaciente').val(result.paciente.id)
				
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

function validar_campos_vacios(contents, vista){
    //vista = 1{crear} , 2{editar}
    var vacio = 0
    if( contents != [] ){
        for (var i = contents.length - 1; i >= 0; i--) {
            if( contents[i]['value'] == '' ){
                if( contents[i]['id'] == "horario_consulta" ||
                        contents[i]['id'] == "identificacion_id" ||
                        contents[i]['id'] == "sexo" ||
                        contents[i]['id'] == "clase" ||
                        contents[i]['id'] == "afiliacion" ||
                        contents[i]['id'] == "ocupacion" ||
                        contents[i]['id'] == "municipio" ||
                        contents[i]['id'] == "depto" ){
                    $('#'+contents[i]['id']).parent('.select-wrapper').children('input').css('border-bottom', '1.5px solid red')
                    $('#'+contents[i]['id']).parent('.select-wrapper').append('<span class="request-input">*Requerido</span>')
                    vacio++
                }else{
                    //permitido pasar en blanco
                    if( contents[i]['id'] == "nombre_2" || contents[i]['id'] == "telefono" || contents[i]['id'] == "celular" ){

                    }else{
                        $('#'+contents[i]['id']).css('border-bottom', '1.5px solid red')
                        $('#'+contents[i]['id']).parent('.input-field').append('<span class="request-input">*Requerido</span>')
                        vacio++
                    }

                }
            }
        }
    }
    return vacio
}

function active_profesional(id){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$.ajax({
		url: window.location.origin+"/pacientes/active",
		method: 'post',
		data: {
			id : id
		},
		success: function(result){
			var str = $('.dev-offline-paciente[data-id="'+id+'"]')
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
        html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp;Paciente '+ ( (result.activo==0) ? "Desactivado" : "Activado" ) +' Correctamente!',
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