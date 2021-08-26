$(document).ready(function(){
	console.log('historia_ordenes v0.1')
	init_ordenes()
})

function init_ordenes(){
	var host = window.location.hostname
	$('#guardar_orden').click(function(){
		if( $('.body_medicamentos > tr').length ){
			var valido_campos = 0
			$('#ordenes input, #ordenes textarea').each(function(){
				if( $(this).val() == 0 || $(this).val() == '' ){
					var ide = $(this).attr('id')
					valido_campos = 1
					$('#'+ide).css('border-bottom', '1.5px solid red')
          $('#'+ide).parent('.input-field').append('<span class="request-input">*Requerido</span>')
				}
			})

			$('#ordenes select').each(function(){
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
				save_orden(host, $('#historia_id').val() )
			}else{
				M.toast({
	        html: 'Hay campos sin llenar para la formula!', 
	        classes: 'toast-error'
	      });
			}

		}else{
			M.toast({
        html: 'No ha Registrado Médicamentos para la Orden!', 
        classes: 'toast-error'
      });
		}
	})
}

//capturar información y guardar orden
function save_orden(host, historia_id){
	
	var orden = {
		historia_id: historia_id,
		td: $('#td').val(),
		formula: $('#formula').val(),
		fecha: $('#o_fecha').val(),
		entidad_id: $('#o_entidad').val(),
		medico_especialista_id: $('#o_profesional_medico').val(),
		ac_alergicos: $('#o_antecedentes_alergicos').val() 
	}

  var paciente = $('.selected-paciente .paciente-id').html()

	//recorrer lista de medicamentos y guardar en arreglo
	function array_medicamentos(){
		var medicamentos = []
		$('.body_medicamentos > tr').each(function(i, obj){
			medicamentos[i] = { 
				medicamento_id: $(this).children('.med-id').html(), 
        codigo_cum: $(this).children('.med-codigo_cum').html(), 
			  nombre_far: $(this).children('.med-nombre_far').html(), 
			  presentacion: $(this).children('.med-presentacion').html(),
			  cantidad: $(this).children().children('input[name="cantidad"]').val(), 
			  dosis: $(this).children().children('input[name="dosis"]').val(),
			  dias: $(this).children().children('input[name="dias"]').val()
			}
		})
		return medicamentos
	}

	//llenar medicamentos
	var medicamentos = array_medicamentos()
	
	//enviar contenido ajax al controlador Historia Ordenes para editar
  $.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://"+host+"/ordenes/crear",
    method: 'post',
    data: {
    	orden:orden,
    	medicamentos:medicamentos
    },
    success: function(result){

      if( result.error ){
        M.toast({html: result.msg, classes: 'rounded'});
      }

      if( result.yes ){
        M.toast({html: result.yes, classes: 'toast-success'});

        $('#js-ordenes-lista-fechas').append(result.fecha_formula)
        $('#js-ordenes-lista-formulas').append(result.content_formula)

        /*edit*/
        var nueva_orden = result.formula;
        nueva_orden++
        /*edit*/
        $('#td').val(nueva_orden)
        $('#formula').val(nueva_orden)

        $('#js-ordenes-lista-formulas > tr').hide()
        $('#js-ordenes-lista-formulas > tr:nth-child(1)').show()
        $('#js-ordenes-lista-fechas > tr.ver-formula-paciente:nth-child(1)').addClass('active')
        $('#js-ordenes-lista-fechas .ver-formula-paciente[data-orden="'+result.id_orden+'"]').click(function(){
          $('#js-ordenes-lista-fechas > tr.ver-formula-paciente').removeClass('active')
          $(this).addClass('active')
          $('#js-ordenes-lista-formulas > tr').hide()
          var id_tab = $(this).data('orden')
          $('#js-ordenes-lista-formulas tr[data-detalle-orden="'+id_tab+'"]').show()
        })

	      //limpiar medicamentos
	      $('.body_medicamentos').empty()
	      //limpiar campos formulario
				$('#o_entidad').val(0)
				$('#o_profesional_medico').val(0)
				$('#o_entidad, #o_profesional_medico').formSelect()
				$('#o_antecedentes_alergicos').val('')
				$('#table_medicamentos').hide()
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
