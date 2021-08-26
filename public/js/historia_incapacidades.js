$(document).ready(function(){
	console.log('historia_incapacidades v0.1')
	init_incapacidades()
})

function init_incapacidades(){
	var host = window.location.hostname
	$('#guardar_incapacidad').click(function(){
			var valido_campos = 0
			$('#incapacidades input, #incapacidades textarea').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.input-field').append('<span class="request-input">*Requerido</span>')
				}
			})

			$('#incapacidades select').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).parent('.select-wrapper').children('input').css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.select-wrapper').append('<span class="request-input">*Requerido</span>')
				}
			})

			//si ningun input es vacio envio
			if( valido_campos == 0 ){
				//GUARDAR NUEVA ORDEN
				save_incapacidad(host, $('#historia_id').val() )
			}else{
				M.toast({
	        html: 'Hay campos sin llenar para la Incapacidad!', 
	        classes: 'toast-error'
	      });
			}

		})
}

//capturar información y guardar paraclinico
//BBDD
//	id	historia_id	td	incapacidad	fecha	hora	entidad	profesional_medico	clase_incapacidad	tipo_incapacidad	dias	inicio	finalizacion	txt_dias	diagnostico	descripcion
//FORM
//	i_td incapacidad i_fecha i_hora i_entidad i_profesional_medico clase_incapacidad tipo_incapacidad inicio finalizacion dias txt_dias i_diagnostico i_descripcion

function save_incapacidad(host, historia_id){

	var dt = new Date();
  var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	
	var incapacidad = {
		historia_id: historia_id,
		td: $('#i_td').val(),
		incapacidad: $('#incapacidad').val(),
		fecha: $('#i_fecha').val(),
  	hora: $('#i_hora').val(),
		entidad: $('#i_entidad').val(),
		profesional_medico: $('#i_profesional_medico').val(),
		clase_incapacidad: $('#clase_incapacidad').val(),
		tipo_incapacidad: $('#tipo_incapacidad').val(),
		dias: $('#dias').val(),
		inicio: $('#inicio').val(),
		finalizacion: $('#finalizacion').val(),
		txt_dias: $('#txt_dias').val(),
		diagnostico: $('#i_diagnostico').val(),
		descripcion: $('#i_descripcion').val()
	}
	
	//enviar contenido ajax al controlador Historia Paraclinicos para crear
  $.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://"+host+"/incapacidades/crear",
    method: 'post',
    data: {
    	incapacidad:incapacidad
    },
    success: function(result){

      if( result.error ){
        M.toast({html: result.msg, classes: 'toast-error'});
      }

      if( result.yes ){
        M.toast({html: result.yes, classes: 'toast-success'});
      }

      if( result.incapacidad ){
        //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS

        
        var fecha_formula = ''+
	        '<tr class="row ver-formula-paciente" data-orden="'+result.incapacidad.id+'" style="margin-bottom: 0px;">'+
	          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.incapacidad.id+'</td>'+
	          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.incapacidad.fecha+'</td>'+
	        '</tr>';
	      $('#js-incapacidades-lista-fechas').append(fecha_formula)

	      var content_formula = ''+
	        '<tr class="row" data-detalle-orden="'+result.incapacidad.id+'" style="margin-bottom: 0px;">'+
	          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
	            '<h5 style="padding-top:7px;">Entidad: '+result.incapacidad.entidad.nombre+'</h5>'+
	          '</td>'+
	          '<td class="col-md-12" style="padding-bottom:0px">'+
	            '<div class="row" style="margin-bottom: 0px;">'+
	              '<div class="col-md-2">'+
	                '<b>Incapacidad:<br></b> '+result.incapacidad.incapacidad+'<br>'+
	              '</div>'+
	              '<div class="col-md-2">'+
	                '<b>Fecha:</b> <br>'+result.incapacidad.fecha+
	              '</div>'+
	              '<div class="col-md-2">'+
	                '<b>Hora:</b> <br>'+result.incapacidad.hora+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Profesional Médico:</b> <br>'+result.incapacidad.medicoEspecialista.nombre+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Clase de Incapacidad:</b> <br>'+result.incapacidad.clase_incapacidad+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Tipo de Incapacidad:</b> <br>'+result.incapacidad.tipo_incapacidad+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Dias:</b> <br>'+result.incapacidad.dias+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Inicio:</b> <br>'+result.incapacidad.inicio+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Finalizacion:</b> <br>'+result.incapacidad.finalizacion+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Días en Letras</b> <br>'+result.incapacidad.txt_dias+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Diagnostico:</b> <br>'+result.incapacidad.diagnostico+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Descripcion:</b> <br>'+result.incapacidad.descripcion+
	              '</div>'+
	            '</div>'+
	          '</td>'+
	        '</tr>';

	      $('#js-incapacidades-lista-formulas').append(content_formula)

		    var nueva_orden = result.incapacidad.incapacidad;
		    nueva_orden++
		    $('#i_td').val(nueva_orden)
		    $('#incapacidad').val(nueva_orden)
		    var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#i_hora').val(time)

	      $('#js-incapacidades-lista-formulas > tr').hide()
			  $('#js-incapacidades-lista-formulas > tr:nth-child(1)').show()
			  $('#js-incapacidades-lista-fechas > tr.ver-formula-paciente:nth-child(1)').addClass('active')
			  $('#js-incapacidades-lista-fechas .ver-formula-paciente').click(function(){
			    $('#js-incapacidades-lista-fechas > tr.ver-formula-paciente[data-orden="'+result.incapacidad.id+'"]').removeClass('active')
			    $(this).addClass('active')
			    $('#js-incapacidades-lista-formulas > tr').hide()
			    var id_tab = $(this).data('orden')
			    $('#js-incapacidades-lista-formulas tr[data-detalle-orden="'+id_tab+'"]').show()
			  })

	      //limpiar campos formulario
				$('#inicio, #finalizacion, #dias, #txt_dias, #i_descripcion').val('')
				$('#i_entidad, #i_profesional_medico, #clase_incapacidad, #tipo_incapacidad, #i_diagnostico')
					.val(0)
					.formSelect()
				

      } // end incapacidades

    },
    error: function(i,o,u){
      console.log('Error al validar')
      console.log(i)
      console.log(o)
      console.log(u)
    }
  });

}