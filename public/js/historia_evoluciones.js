$(document).ready(function(){
	console.log('historia_evoluciones v0.1')
	init_evoluciones()
})

function init_evoluciones(){
	var host = window.location.hostname
	$('#guardar_evolucion').click(function(){
			var valido_campos = 0
			$('#evoluciones input, #evoluciones textarea').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.input-field').append('<span class="request-input">*Requerido</span>')
				}
			})

			$('#evoluciones select').each(function(){
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
				save_evoluciones(host, $('#historia_id').val() )
			}else{
				M.toast({
	        html: 'Hay campos sin llenar para la Evolución!', 
	        classes: 'toast-error'
	      });
			}

		})
}

//capturar información y guardar paraclinico
//BBDD
//   id  historia_id  td  remision  fecha  hora  entidad  profesional_medico  especialidad  diagnostico  enfermedad_actual  contra  hallazgos  examenes  tratamiento  created_at  updated_at
//FORM

function save_evoluciones(host, historia_id){
	
	var evolucion = {
		historia_id : historia_id,
		td : $('#e_td').val(),
		control : $('#e_control').val(),
		fecha : $('#e_fecha').val(),
		hora : $('#e_hora').val(),
		entidad : $('#e_entidad').val(),
		profesional_medico : $('#e_profesional_medico').val(),
		subjetivo : $('#subjetivo').val(),
		objetivo : $('#objetivo').val(),
		descripcion : $('#e_descripcion').val(),
		observaciones : $('#e_observaciones').val(),
		intervencion : $('#e_intervencion').val()
	}
	
	//enviar contenido ajax al controlador Historia Paraclinicos para crear
  $.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://"+host+"/evoluciones/crear",
    method: 'post',
    data: {
    	evolucion:evolucion
    },

    success: function(result){

      if( result.error ){
        M.toast({html: result.msg, classes: 'toast-error'});
      }

      if( result.yes ){
        M.toast({html: result.yes, classes: 'toast-success'});
      }

      if( result.evolucion ){
        //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
        var fecha_formula = ''+
	        '<tr class="row ver-formula-paciente" data-orden="'+result.evolucion.id+'" style="margin-bottom: 0px;" >'+
	          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.evolucion.control+'</td>'+
	          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.evolucion.fecha+'</td>'+
	        '</tr>';
	      $('#js-referencias-lista-fechas').append(fecha_formula)

	      var content_formula = ''+
	        '<tr class="row" data-detalle-orden="'+result.evolucion.id+'" >'+
	          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
	            '<h5 style="padding-top:7px;">Entidad: '+result.evolucion.entidad.nombre+'</h5>'+
	          '</td>'+
	          '<td class="col-md-12" style="padding-bottom:0px">'+
	            '<div class="row" style="margin-bottom: 0px;">'+
	              '<div class="col-md-2">'+
	                '<b>Remision:<br></b> '+result.evolucion.control+'<br>'+
	              '</div>'+
	              '<div class="col-md-2">'+
	                '<b>Fecha:</b> <br>'+result.evolucion.fecha+
	              '</div>'+
	              '<div class="col-md-2">'+
	                '<b>Hora:</b> <br>'+result.evolucion.hora+
	              '</div>'+
	              '<div class="col-md-12">'+
	                '<b>Profesional Médico:</b> <br>'+result.evolucion.medicoEspecialista.nombre+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Subjetivo:</b> <br>'+result.evolucion.subjetivo+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Objetivo:</b> <br>'+result.evolucion.objetivo+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Descripcion:</b> <br>'+result.evolucion.descripcion+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Observaciones:</b> <br>'+result.evolucion.observaciones+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Intervencion:</b> <br>'+result.evolucion.intervencion+
	              '</div>'+
	            '</div>'+
	          '</td>'+
	          '<!-- Archivo Descargable -->'+
	          '<td class="col-md-12" style="padding-bottom:0px;padding-top:0px;">'+
	            '<div class="row" style="margin-bottom: 0px;">'+
	              '<div class="col-md-12 text-center">'+
	                '<a href="'+window.location.origin+'/descargar-evolucion/'+result.evolucion.id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
	                  '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
	                '</a>'+
	              '</div>'+
	            '</div>'+
	          '</td>'+
	        '</tr>';

	      $('#js-evoluciones-lista-formulas').append(content_formula)

		    var nueva_orden = result.evolucion.control;
		    nueva_orden++
		    $('#e_td').val(nueva_orden)
		    $('#e_ontrol').val(nueva_orden)
		    var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#e_hora').val(time)

			  $('#js-evoluciones-lista-formulas > tr').hide()
			  $('#js-evoluciones-lista-formulas > tr:nth-child(1)').show()
			  $('#js-evoluciones-lista-fechas > tr.ver-formula-paciente:nth-child(1)').addClass('active')
			  $('#js-evoluciones-lista-fechas .ver-formula-paciente').click(function(){
			    $('#js-evoluciones-lista-fechas > tr.ver-formula-paciente[data-orden="'+result.evolucion.id+'"]').removeClass('active')
			    $(this).addClass('active')
			    $('#js-evoluciones-lista-formulas > tr').hide()
			    var id_tab = $(this).data('orden')
			    $('#js-evoluciones-lista-formulas tr[data-detalle-orden="'+id_tab+'"]').show()
			  })

	      //limpiar campos formulario
 				$('#subjetivo, #objetivo, #e_descripcion, #e_observaciones').val('')
				$('#e_entidad, #e_profesional_medico, #e_intervencion')
					.val(0)
					.formSelect()
				

      } // end referencias

    },
    error: function(i,o,u){
      console.log('Error al validar')
      console.log(i)
      console.log(o)
      console.log(u)
    }
  });

}


function get_entidad( id ){

  return $('#entidad option[value="'+id+'"]').html()

}

function get_profesional( id ){

  return $('#profesional_medico option[value="'+id+'"]').html()

}