$(document).ready(function(){
	console.log('historia_referencias v0.1')
	init_referencias()
})

function init_referencias(){
	var host = window.location.hostname
	$('#guardar_referencia').click(function(){
			var valido_campos = 0
			$('#referencias input, #referencias textarea').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.input-field').append('<span class="request-input">*Requerido</span>')
				}
			})

			$('#referencias select').each(function(){
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
				save_referencias(host, $('#historia_id').val() )
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
//   id  historia_id  td  remision  fecha  hora  entidad  profesional_medico  especialidad  diagnostico  enfermedad_actual  contra  hallazgos  examenes  tratamiento  created_at  updated_at
//FORM

function save_referencias(host, historia_id){
	
	var referencia = {
		historia_id: historia_id,
		td: $('#r_td').val(),
		remision: $('#remision').val(),
		fecha: $('#r_fecha').val(),
		hora: $('#r_hora').val(),
		entidad: $('#r_entidad').val(),
		profesional_medico: $('#r_profesional_medico').val(),
		especialidad: $('#especialidad').val(),
		diagnostico: $('#r_diagnostico').val(),
		enfermedad_actual: $('#r_enfermedad_actual').val(),
		contra: $('#contra').val(),
		hallazgos: $('#hallazgos').val(),
		examenes: $('#exameness').val(),
		tratamiento: $('#r_tratamiento').val()
	}
	
	//enviar contenido ajax al controlador Historia Paraclinicos para crear
  $.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://"+host+"/referencias/crear",
    method: 'post',
    data: {
    	referencia:referencia
    },

    success: function(result){

      if( result.error ){
        M.toast({html: result.msg, classes: 'toast-error'});
      }

      if( result.yes ){
        M.toast({html: result.yes, classes: 'toast-success'});
      }

      if( result.referencia ){
        //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
        var fecha_formula = ''+
	        '<tr class="row ver-formula-paciente" data-orden="'+result.referencia.id+'" style="margin-bottom: 0px;" >'+
	          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.referencia.remision+'</td>'+
	          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.referencia.fecha+'</td>'+
	        '</tr>';
	      $('#js-referencias-lista-fechas').append(fecha_formula)

	      result.referencia.entidad = get_entidad( result.referencia.entidad )
	      result.referencia.profesional_medico = get_profesional( result.referencia.profesional_medico )

	      var content_formula = ''+
	        '<tr class="row" data-detalle-orden="'+result.referencia.id+'" >'+
	          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
	            '<h5 style="padding-top:7px;">Entidad: '+result.referencia.entidad+'</h5>'+
	          '</td>'+
	          '<td class="col-md-12" style="padding-bottom:0px">'+
	            '<div class="row" style="margin-bottom: 0px;">'+
	              '<div class="col-md-2">'+
	                '<b>Remision:<br></b> '+result.referencia.remision+'<br>'+
	              '</div>'+
	              '<div class="col-md-2">'+
	                '<b>Fecha:</b> <br>'+result.referencia.fecha+
	              '</div>'+
	              '<div class="col-md-2">'+
	                '<b>Hora:</b> <br>'+result.referencia.hora+
	              '</div>'+
	              '<div class="col-md-6">'+
	                '<b>Profesional Médico:</b> <br>'+result.referencia.profesional_medico+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Especialidad:</b> <br>'+result.referencia.especialidad+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Diagnostico:</b> <br>'+result.referencia.diagnostico+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Enfermedad Actual:</b> <br>'+result.referencia.enfermedad_actual+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Fecha:</b> <br>'+result.referencia.contra+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Hallazgos:</b> <br>'+result.referencia.hallazgos+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Examenes:</b> <br>'+result.referencia.examenes+
	              '</div>'+
	              '<div class="col-md-3">'+
	                '<b>Tratamiento:</b> <br>'+result.referencia.tratamiento+
	              '</div>'+
	            '</div>'+
	          '</td>'+
	        '</tr>';

	      $('#js-referencias-lista-formulas').append(content_formula)

		    var nueva_orden = result.referencia.remision;
		    nueva_orden++
		    $('#r_td').val(nueva_orden)
		    $('#remision').val(nueva_orden)
		    var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#r_hora').val(time)

			  $('#js-referencias-lista-formulas > tr').hide()
			  $('#js-referencias-lista-formulas > tr:nth-child(1)').show()
			  $('#js-referencias-lista-fechas > tr.ver-formula-paciente:nth-child(1)').addClass('active')
			  $('#js-referencias-lista-fechas .ver-formula-paciente').click(function(){
			    $('#js-referencias-lista-fechas > tr.ver-formula-paciente[data-orden="'+result.referencia.id+'"]').removeClass('active')
			    $(this).addClass('active')
			    $('#js-referencias-lista-formulas > tr').hide()
			    var id_tab = $(this).data('orden')
			    $('#js-referencias-lista-formulas tr[data-detalle-orden="'+id_tab+'"]').show()
			  })

	      //limpiar campos formulario
				$('#especialidad, #r_enfermedad_actual, #hallazgos, #exameness, #r_tratamiento').val('')
				$('#r_entidad, #r_profesional_medico, #r_diagnostico')
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