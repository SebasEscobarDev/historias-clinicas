$(document).ready(function(){
  //3127216368
  console.log('test historiass v=0.6')

  init_date_pickers()

	/*
   *   CRUD hospitalizacion
   */
  $('#table_medicamentos').hide()

	crud_historias()
  select_medicamento()

  buscador_modal('buscar-pacientes')
  buscador_texto('buscar-pacientes')

  buscador_modal('buscar-medicamentos')
  buscador_texto('buscar-medicamentos')

})

function select_medicamento(){
  $('.dev-select-medicamento').click(function(){
    var ide = $(this).data('select')
    var codigo_cum = $('.medicamento-'+ide+' .m-codigo_cum').html()
    var nombre_far = $('.medicamento-'+ide+' .m-nombre_far').html()
    var presentacion = $('.medicamento-'+ide+' .m-presentacion').html()
    var action = 0
    var vacio;
    var existe;

    if( $('.body_medicamentos .med-id').length > 0 ){
      $('.body_medicamentos .med-id').each(function(){
        var value = $(this).html()
        if( value == ide ){
          existe = 1
        }
      })
    }

    if( existe == 1 ){
      M.toast({
        html: 'Medicamento ya ingresado!', 
        classes: 'toast-error'
      });
    }else{
      var row_html = '<tr class="center">'+
        '<td class="med-id">'+ide+'</td>'+
        '<td class="med-codigo_cum">'+codigo_cum+'</td>'+
        '<td class="med-nombre_far">'+nombre_far+'</td>'+
        '<td class="med-presentacion">'+presentacion+'</td>'+
        '<td class="center"><input class="validate center col-md-8" name="cantidad" type="number" placeholder="0"></td>'+
        '<td class="center"><input class="validate center col-md-12" name="dosis" type="text" placeholder="DOSIS"></td>'+
        '<td class="center"><input class="validate center col-md-12" name="dias" type="text" placeholder="Días / Meses"></td>'+
      '</tr>'
      $('.body_medicamentos').append(row_html)
      //mostrar tabla de medicamentos
      $('#table_medicamentos').show()
    }

  })
}


function buscador_modal(modal){
  $('#div-'+modal).hide()
  $('#btn-'+modal).click(function(){
    if( $(this).data('click') == 0 ){
      $('#div-'+modal).show("slow")
      $(this).data('click', 1)
    }else if( $(this).data('click') == 1 ){
      $('#div-'+modal).hide("slow")
      $(this).data('click', 0)
    }
  })
}


function buscador_texto(modal){
  $(document).on('keyup', '#'+modal, function(){
    var query = $(this).val();
    buscador(query, modal);
  });
  $("#clear-"+modal).click( function(i,obj){
    buscador('', modal);
    $('#'+modal).val('');    
    $('#'+modal).removeClass('valid')
    $('label[for="'+modal+'"]').removeClass('active')
  })
}



function buscador(query = '', modal)
{

  if( modal == 'buscar-pacientes' ){
    var url = window.location.origin+"/buscar-paciente"
  }else if( modal == 'buscar-medicamentos' ){
    var url = window.location.origin+"/buscar-medicamento"
  }else if( modal == 'buscar-historias' ){
    var url = window.location.origin+"/buscar-historia"
  }

  $.ajax({
    url: url,
    method:'GET',
    data:{query:query,
          vista:'historia'},
    dataType:'json',
    success:function(data)
    {
      if( data.origen == 'buscador-pacientes' ){
        $('#table-pacientes-2').html(data.table_data);
        cargar_boton_adicionar_paciente_a_historia()
      }else if( data.origen == 'buscador-medicamentos' ){
        $('#table-medicamentos').html( data.table_data );
        select_medicamento()
      }
      //Cargar ancho de columnas en headers tablas
      header_tablas(data.origen)

      //tootltip functions
      $('.tooltipped').tooltip({'margin':0});
      //$('#total_records').text(data.total_data);
    }
  })
}

function header_tablas(origen){
  //width table headers
  var n_rows = $('.'+origen+' .dev-table-fix table thead tr th').length
  for( var i = 1; i <= n_rows; i++ ){
    $('.'+origen+' .dev-stick > tr > th:nth-child('+i+')').width( $('.'+origen+' .dev-table-fix table thead tr th:nth-child('+i+')').width() )
  }
}

function cargar_boton_adicionar_paciente_a_historia(){
  $('.dev-select-paciente').click(function(){
    seleccionar_paciente_para_historia($(this).data('select'))
  })
}


function init_date_pickers(){
  var pickers = document.querySelectorAll('.datepicker');

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
    onChange: function(selectedDates, dateStr, instance) {},
  };

  Array.prototype.forEach.call(pickers, (el) => {
    flatpickr(el, config);
  });
}

function crud_historias(){

  var host = window.location.hostname

  /************                                           [1]
  ** VISTAS **               
  ************/
  $('.vistas').hide()
  $('#list').show()
  $('#editar').hide()

  /******************************************         [2]
  ** BOTON VER LA VISTA REGISTRAR HISTORIA **
  *******************************************/
  cargar_boton_adicionar_paciente_a_historia()

  /*****************************                      [3]
  ** BOTON REGISTRAR HISTORIA **
  ******************************/
  $('#registrar').click(function(){
    /*  
      PRUEBA ON:
        registrar_nueva_historia(host, 1)
      PRUEBA OFF:
        registrar_nueva_historia(host, 0)
    */
    registrar_nueva_historia(host, 0)
  })

  /***************************                         [4]
   ** VISTA EDITAR HISTORIA **
   ***************************/
  //Continuar historia
  $('.dev-count-historia').click(function(){
    //botones
    $('#registrar').hide()
    $('#editar').show()
    //funcion ver_historia a continuar
    continuar_historia(host,$(this).data('edit'))
  })

  /***************************                         [5]
   ** BOTON EDITAR HISTORIA **
   ***************************/
  $('#editar').click(function(){
    edit_content(host, $(this).data('edit'))
  })

  /******************                                  [7]
   ** BOTON VOLVER **
   ******************/
  $('.dev-volver').click(function(){
    limpiar_formulario_historias()
    active_label_form(0)
    $('.vistas').hide()
    $('#list').show()
	})

  /**********************************                     [8]
   ** BOTON ARCHIVAR HISTORIA **
   **********************************/
  /*$('.dev-offline-paciente').click(function(){
    active_profesional(host, $(this).data('id'), $(this).data('active'))
  })*/
}

function seleccionar_paciente_para_historia(paciente){
  limpiar_formulario_historias()
  active_label_form(0)
  //mostrar boton registrar
  $('#editar').hide()
  $('#registrar').show()
  //agregar número de la historia
  $('#historia_id').val($('#his_id').val())
  $('label[for="historia_id"]').addClass('active')
  //agregar fecha de la historia
  var today = getFecha()
  //agregar fecha al input fecha_historia
  $('#f_historia').val(today)
  $('label[for="f_historia"]').addClass('active')
  //agregar hora al input hora_historia
  var dt = new Date();
  var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
  $('#hora_historia').val(time)
  $('label[for="hora_historia"]').addClass('active')
  $('.selected-paciente').html('')
  $('.dev-detail-paciente-'+paciente+' > .details-paciente').clone().appendTo('.selected-paciente')
  //actualizar nombre de titulo en historia
  $('.title-historia-up').html('REGISTRAR')
  //activar inputs de historia
  $('#motivo_consulta, #antecedentes_personales, #enfermedad_actual, #antecedentes_familiares, #antecedentes_alergicos, #af_enfermedad_mental, #o_antecedentes_alergicos')
    .removeAttr('disabled')
  $('#tension_arterial, #fc_lxm, #fr_rxm, #temperatura, #peso, #talla, #imc, #exploracion_general, #otros_resultados')
    .removeAttr('disabled')
  $('#ingreso, #egreso, #relacionado_1, #relacionado_2, #impresion_dx, #notas_privadas, #tratamiento, #observaciones')
    .removeAttr('disabled')
  $('#ingreso, #egreso, #relacionado_1, #relacionado_2').formSelect()
  //ocultar tabs y activar pestaña de antecedes
  $('.dev-title-tabs > ul > li').each(function(i,obj){
    if( i > 2 ){
      $(this).hide()
    }
  })
  $('a[href="#antecedentes"]')
    .addClass('active')
  $('#antecedentes')
    .addClass('active')
    .show()
  //reinitialice tabs
  $('.tabs').tabs();

  //mostrar vistas
  $('.vistas').hide()
  $('#create').show()
}

function getFecha(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; 
  var yyyy = today.getFullYear();
  dd = ( dd < 10 ) ? '0'+dd : dd ;
  mm = ( mm < 10 ) ? '0'+mm : mm ;
  return today = yyyy+'-'+mm+'-'+dd;
}

//Funcion para actualizar datos de la historia en la vista
function response_crear_editar_content(result, vista){

    //crear
    if( vista == 1 ){
        if ( $('.list > tr:last-of-type').clone().appendTo('.list') ){
            $('.list > tr:last-of-type').attr('data-id', result.historia.id)
            $('.row-id[data-id="'+result.historia.id+'"] .id').html($('.list > tr').length)
        }
    }
    limpiar_formulario_historias()
    $('.vistas').hide()
    $('#list').show()

    //datos actualizados del $paciente
    setTimeout(function(){
      var historia_id = '.row-id[data-id="'+result.historia.id+'"]'
      var nombre = result.historia.paciente.nombre_1+' '+result.historia.paciente.nombre_2+' '+result.historia.paciente.apellido_1+' '+result.historia.paciente.apellido_2
      $(historia_id+' .historia-created_at').html(result.historia.created_at)
      $(historia_id+' .documento').html(result.historia.paciente.documento)
      $(historia_id+' .nombre').html(nombre)
      $(historia_id+' .edad').html(result.historia.paciente.edad)
      $(historia_id+' .sexo').html(result.historia.paciente.sexo)
      $(historia_id+' a.dev-count-historia').attr({'data-edit':result.historia.id})


      /***************************                         [4]
       ** VISTA EDITAR HISTORIA **
       ***************************/
      //Continuar historia
      $(historia_id+' .dev-count-historia').click(function(){
        var host = window.location.hostname
        $('#registrar').hide()
        $('#editar').show()
        //funcion ver_historia a continuar
        continuar_historia(host,$(this).data('edit'))
      })

      /**********************************                     [8]
       ** BOTON DESACTIVAR PROFESIONAL **
       **********************************/
       /*
      $('.row-id[data-id="'+result.medico.id+'"] .dev-offline-profesional').click(function(){
          var host = window.location.hostname
          active_profesional(host, $(this).data('id'), $(this).data('active'))
      })
      */

      //Update stick header table
      var n_rows = $('.dev-table-fix table thead tr th').length
      for( var i = 1; i <= n_rows; i++ ){
          $('.dev-stick > tr > th:nth-child('+i+')').width( $('.dev-table-fix table thead tr th:nth-child('+i+')').width() )
      }

    },300)

}


function registrar_nueva_historia(host, prueba){

  // si la variable prueba es igual a 1, las pruebas estan activadas

  if ( prueba == 0 ){

    var historia = {
      paciente_id : $('.selected-paciente .paciente-id').text(),
      f_historia : $('#f_historia').val(),
      hora_historia : $('#hora_historia').val(),
      entidad : $('#entidad').val(),
      profesional_medico : $('#profesional_medico').val(),
      acompanante : $('#acompanante').val(),
      parentesco : $('#parentesco').val(),
      telefono : $('#telefono').val()
    }

    var vacio = 0

    //Validar inputs vacios
    for(var clave in historia) {
      if( historia[clave] == "" || historia[clave] == 0 ){
        //permitir pasar en blanco
        if( clave == "f_egreso" ){

        }else{
          if( clave == "entidad" || clave == "profesional" ){
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
      
  }else{
    //CODIGO PARA EJECUCION DE PRUEBAS
  }

  if( vacio == 0 ){

    var antecedentes = {
      motivo_consulta : $('#motivo_consulta').val(),
      antecedentes_personales : $('#antecedentes_personales').val(),
      enfermedad_actual : $('#enfermedad_actual').val(),
      antecedentes_familiares : $('#antecedentes_familiares').val(),
      antecedentes_alergicos : $('#antecedentes_alergicos').val(),
      af_enfermedad_mental : $('#af_enfermedad_mental').val()
    },
    examenes = {
      tension_arterial : $('#tension_arterial').val(),
      fc_lxm : $('#fc_lxm').val(),
      fr_rxm : $('#fr_rxm').val(),
      temperatura : $('#temperatura').val(),
      peso : $('#peso').val(),
      talla : $('#talla').val(),
      imc : $('#imc').val(),
      exploracion_general : $('#exploracion_general').val(),
      otros_resultados : $('#otros_resultados').val()
    },
    dxtratamiento = {
      ingreso : $('#ingreso').val(),
      egreso : $('#egreso').val(),
      relacionado_1 : $('#relacionado_1').val(),
      relacionado_2 : $('#relacionado_2').val(),
      impresion_dx : $('#impresion_dx').val(),
      notas_privadas : $('#notas_privadas').val(),
      tratamiento : $('#tratamiento').val(),
      observaciones : $('#observaciones').val()
    }

    //valido campos
    if( dxtratamiento['ingreso'] == '' ||
        dxtratamiento['ingreso'] == 0 ){
      /*STYLE SELECTS WITH NO CONTENT*/
      $('#ingreso').parent('.select-wrapper').children('input').css('border-bottom', '1.5px solid red')
      $('#ingreso').parent('.select-wrapper').append('<span class="request-input">*Requerido</span>')
      M.toast({html: 'Ingrese todos los campos requeridos', classes: 'toast-error'});
      return 
    }

    //enviar contenido ajax al controlador Historia para insertar
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "http://"+host+"/historia/crear",
      method: 'post',
      data: {
        historia: historia,
        antecedentes: antecedentes,
        examenes: examenes,
        dxtratamiento: dxtratamiento
      },
      success: function(result){

        if( result.error ){
          M.toast({html: result.error, classes: 'toast-error'});
        }

        if( result.yes ){
          M.toast({
              html: '<i class="material-icons">check_circle</i>&nbsp;&nbsp;&nbsp;'+result.yes,
              classes: 'toast-success',
              displayLength:5000
          });
          //response_crear_editar_content(resultado, vista)
          response_crear_editar_content(result, 1)
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
    M.toast({html: 'Ingrese todos los campos requeridos', classes: 'toast-error'});
  }// insert
}



function limpiar_formulario_historias(){
  
  $('.frm-registro-historias input').each(function(){
    $(this).val('')
  })

  $('.frm-registro-historias textarea').each(function(){
    $(this).val('')
  })

  $('.frm-registro-historias select').each(function(){

    if( $(this).children('option').attr('selected') ){
      $(this).children('option').removeAttr('selected')
    }

  })

}

    //////  //////  //////  //////    //      //////  //      //  //////    //   //
   //      //  //    //    //  //    //      //  //  //      //  //      //  / /  //
  //      //////    //    //////    //      //  //    //  //    //////   //  /  //
 //      //  //    //    //  //    //      //  //    //  //    //        //  //
//////  //  //    //    //  //    //////  //////      //      //////      //

function edit_content(host, id){

  var historia = {
    historia_id : $('#historia_id').val(),
    entidad : $('#entidad').val(),
    profesional_medico : $('#profesional_medico').val(),
    acompanante : $('#acompanante').val(),
    parentesco : $('#parentesco').val(),
    telefono : $('#telefono').val()
  }

  var vacio = 0

  //Validar inputs vacios
  for(var clave in historia) {
    //console.log(clave+": " +historia[clave])
    if( historia[clave] == "" || historia[clave] == 0 ){
      //permitir pasar en blanco
      if( clave == "f_egreso" ){

      }else{
        if( clave == "entidad" || clave == "profesional" ){
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

  if( vacio == 0 ){

    //enviar contenido ajax al controlador His para editar
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      url: "http://"+host+"/historia/editar",
      method: 'post',
      data: { 
        historia: historia 
      },
      success: function(result){

        if( result.error ){
          M.toast({html: result.msg, classes: 'toast-error'});
        }

        if( result.yes ){
          M.toast({html: result.yes, classes: 'toast-success'});
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
    M.toast({html: 'Ingrese todos los campos requeridos', classes: 'toast-error'});
  }

}

/* Función que muestra la vista para continaur la edición de la historia */
function continuar_historia(host,id){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "http://"+host+"/historia/ver",
    method: 'get',
    data: {
        id : id
    },
    success: function(result){

      if ( result.historia ) {

        //mostrar tabs y activar pestaña de antecedes
        $('.dev-title-tabs > ul > li').each(function(i,obj){
          $(this).show()
        })
        $('a[href="#antecedentes"]')
          .addClass('active')
        $('#antecedentes')
          .addClass('active')
          .show()
        //reinitialice tabs
        $('.tabs').tabs();

        //resultado de la historia
        console.log( result.historia )

        /*PACIENTE SELECCIONADO*/
        $('.selected-paciente').html('')
        var paciente = result.historia.paciente_id
        $('.dev-detail-paciente-'+paciente+' > .details-paciente').clone().appendTo('.selected-paciente')
        //actualizar nombre de titulo en historia
        $('.title-historia-up').html('CONTINUAR')
        
        //Iniciar Selects Genéricos
        //$('select').formSelect()
        //historia
        $('#historia_id').val(result.historia.id)
        $('#historia-created_at').val(result.historia.created_at)
        if( result.historia.f_egreso != null ){
          $('#f_egreso').val(result.historia.f_egreso);
        }else{
          //$('#f_egreso').hide();
        }
        $('#entidad').val(result.historia.entidad_id)
        $('#profesional_medico').val(result.historia.medico_especialista_id)
        $('#acompanante').val(result.historia.acompanante)
        $('#parentesco').val(result.historia.parentesco)
        $('#telefono').val(result.historia.telefono)
        //selects[entidad, profesional]
        $('#entidad, #profesional_medico').formSelect()

        //antecedentes
        $('#motivo_consulta').val(result.historia.antecedente.motivo_consulta)
        $('#antecedentes_personales').val(result.historia.antecedente.antecedentes_personales)
        $('#enfermedad_actual').val(result.historia.antecedente.enfermedad_actual)
        $('#antecedentes_familiares').val(result.historia.antecedente.antecedentes_familiares)
        $('#antecedentes_alergicos').val(result.historia.antecedente.antecedentes_alergicos)
        $('#af_enfermedad_mental').val(result.historia.antecedente.af_enfermedad_mental)
        //desactivar edicion
        $('#motivo_consulta, #antecedentes_personales, #enfermedad_actual, #antecedentes_familiares, #antecedentes_alergicos, #af_enfermedad_mental')
          .attr('disabled', 'disabled')

        //examenes
        $('#tension_arterial').val(result.historia.examen.tension_arterial)
        $('#fc_lxm').val(result.historia.examen.fc_lxm)
        $('#fr_rxm').val(result.historia.examen.fr_rxm)
        $('#temperatura').val(result.historia.examen.temperatura)
        $('#peso').val(result.historia.examen.peso)
        $('#talla').val(result.historia.examen.talla)
        $('#imc').val(result.historia.examen.imc)
        $('#exploracion_general').val(result.historia.examen.exploracion_general)
        $('#otros_resultados').val(result.historia.examen.otros_resultados)
        $('#tension_arterial, #fc_lxm, #fr_rxm, #temperatura, #peso, #talla, #imc, #exploracion_general, #otros_resultados')
          .attr('disabled', 'disabled')

        //dxtratamiento
        $('#ingreso').val(result.historia.dxtratamiento.ingreso)
        $('#egreso').val(result.historia.dxtratamiento.egreso)
        $('#relacionado_1').val(result.historia.dxtratamiento.relacionado_1)
        $('#relacionado_2').val(result.historia.dxtratamiento.relacionado_2)
        $('#impresion_dx').val(result.historia.dxtratamiento.impresion_dx)
        $('#notas_privadas').val(result.historia.dxtratamiento.notas_privadas)
        $('#tratamiento').val(result.historia.dxtratamiento.tratamiento)
        $('#observaciones').val(result.historia.dxtratamiento.observaciones)
        //desactivar inputs
        $('#ingreso, #egreso, #relacionado_1, #relacionado_2, #impresion_dx, #notas_privadas, #tratamiento, #observaciones')
          .attr('disabled', 'disabled')
        //selects[ingreso, egreso, relacionado_1, relacionado_2]
        $('#ingreso, #egreso, #relacionado_1, #relacionado_2').formSelect()


        //activar tabs para continuar resgistro de historia
        $('.tabs-historia > li:nth-child(4), '+
          '.tabs-historia > li:nth-child(5), '+
          '.tabs-historia > li:nth-child(6), '+
          '.tabs-historia > li:nth-child(7), '+
          '.tabs-historia > li:nth-child(8)').show()



        //Ordenes médicas
        var today = getFecha()

        $('#o_fecha').val(today)
        if( result.historia.ordenes.length > 0 ) {

          push_content_html_in_modal( 
            'ordenes' ,
            '#js-ordenes-lista-fechas',
            '#js-ordenes-lista-formulas', 
            result 
          )          

        }else{
          //Si el paciente no tiene ordenes médicas
          $('#td').val(1)
          $('#formula').val(1)
        } //FIN Ordénes Médicas


        //Paraclinicos
        $('#p_fecha').val(today)
        if( result.historia.paraclinicos.length > 0 ) {

          push_content_html_in_modal( 
            'paraclinicos' , 
            '#js-paraclinicos-lista-fechas', 
            '#js-paraclinicos-lista-formulas', 
            result 
          )

        }else{
          //Si el paciente no tiene paraclinicos
          $('#p_td').val(1)
          $('#solicitud').val(1)
        }


        //incapacidades
        $('#i_fecha').val(today)
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#i_hora').val(time)
        if( result.historia.incapacidades.length > 0 ){

          push_content_html_in_modal( 
            'incapacidades' , 
            '#js-incapacidades-lista-fechas', 
            '#js-incapacidades-lista-formulas', 
            result 
          )          

        }else{
          //si el paciente no tiene incapacidades
          $('#i_td').val(1)
          $('#incapacidad').val(1)
        }

        //referencias
        $('#r_fecha').val(today)
        $('#contra').val(today)
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#r_hora').val(time)
        if( result.historia.referencias.length > 0 ){

          push_content_html_in_modal( 
            'referencias' ,
            '#js-referencias-lista-fechas',
            '#js-referencias-lista-formulas',
            result 
          )          

        }else{
          //si el paciente no tiene referencias 
          $('#r_td').val(1)
          $('#remision').val(1)
        }


        //evoluciones
        $('#e_fecha').val(today)
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('#e_hora').val(time)
        if( result.historia.evoluciones.length > 0 ){

          push_content_html_in_modal( 
            'evoluciones' , 
            '#js-evoluciones-lista-fechas', 
            '#js-evoluciones-lista-formulas', 
            result 
          )          

        }else{
          //si el paciente no tiene evoluciones 
          $('#e_td').val(1)
          $('#e_control').val(1)
        }

        active_label_form(1)

        $('#editar').attr('data-edit', result.historia.id)
        $('#editar').show()
        $('.vistas, #registrar').hide()
        //vista
        $('#create').show()
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
}

function active_label_form(estado){
  var campos = $('.frm-registro-historias label')
  if( estado == 1 ){
    campos.addClass('active')
  }else{
    campos.removeClass('active')
    //set default value select
    $('.frm-registro-historias select').each(function(){
      $(this).val(0)
      $(this).formSelect()
    })
  }
}

//push_content_html_in_modal( 'ordenes' , '#js-ordenes-lista-fechas', '#js-ordenes-lista-formulas', result )          
function push_content_html_in_modal( vista, tabla1, tabla2, result ){
  $(tabla1).html('')
  $(tabla2).html('')
  if( vista == 'ordenes' ){
    for( var orden in result.historia.ordenes ) {
      //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
      //result.ordenes[orden].historia_id
      var fecha_formula = ''+
        '<tr class="row ver-formula-paciente" data-orden="'+result.historia.ordenes[orden].id+'" style="margin-bottom: 0px;">'+
          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.historia.ordenes[orden].formula+'</td>'+
          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.historia.ordenes[orden].fecha+'</td>'+
        '</tr>';
      $(tabla1).append(fecha_formula)

      //for de txt medicamentos
      var html_medicamentos = ''
      var array_medicamentos = JSON.parse( result.historia.ordenes[orden].medicamentos )
      for( var clave in array_medicamentos ) {
        html_medicamentos += '<tr class="ver-medicamento" style="margin-bottom: 0px;">'+
            '<td>'+array_medicamentos[clave].codigo_cum+'</td>'+
            '<td>'+array_medicamentos[clave].nombre_far+'</td>'+
            '<td>'+array_medicamentos[clave].presentacion+'</td>'+
            '<td>'+array_medicamentos[clave].cantidad+'</td>'+
            '<td>'+array_medicamentos[clave].dosis+'</td>'+
            '<td>'+array_medicamentos[clave].dias+'</td>'+
          '</tr>';
      }

      var content_formula = ''+
        '<tr data-detalle-orden="'+result.historia.ordenes[orden].id+'" style="margin-bottom: 0px;">'+
          '<td class="col-md-12">'+
            '<table>'+
              '<tr>'+
                '<th colspan="6" class="text-center blue darken-2 text-white" style="padding:0px">'+
                  '<h5 style="padding-top:7px;">Entidad: '+result.historia.ordenes[orden].entidad.nombre_entidad+'</h5>'+
                '</th>'+
              '</tr>'+
              '<tr>'+
                '<td><b>Formula:</b><br>'+result.historia.ordenes[orden].formula+'</td>'+
                '<td colspan="2"><b>Fecha:</b><br>'+result.historia.ordenes[orden].fecha+'</td>'+
                '<td colspan="2"><b>Profesional Médico:</b><br>'+result.historia.ordenes[orden].medico_especialista.nombre+'</td>'+
              '</tr>'+
              '<tr>'+
                '<th colspan="6" class="text-center blue darken-2 text-white" style="padding:0px">'+
                  '<h5 style="padding-top:1px;margin-bottom:3px;">Medicamentos</h5>'+
                '</th>'+
              '</tr>'+
              '<tr>'+
                '<th>Código Cum</th>'+
                '<th>Nombre</th>'+
                '<th>Presentación</th>'+
                '<th>Cantidad</th>'+
                '<th>Dosis</th>'+
                '<th>Días / Meses</th>'+
              '</tr>'+
              ''+html_medicamentos+''+
              '<tr>'+
                '<!-- Archivo Descargable -->'+
                '<td colspan="6" style="padding-bottom:0px;padding-top:0px;">'+
                  '<div class="row" style="margin-bottom: 0px;">'+
                    '<div class="col-md-12 text-center">'+
                      '<a href="'+window.location.origin+'/descargar-orden/'+result.historia.paciente_id+'/'+result.historia.ordenes[orden].historia_id+'/'+result.historia.ordenes[orden].id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
                        '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
                      '</a>'+
                      '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                      '<a href="#view-edit-orden" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
                        '<i class="material-icons small">edit</i>&nbsp;<span>Editar Orden</span>'+
                      '</a>'+
                    '</div>'+
                  '</div>'+
                '</td>'+
              '</tr>'+
            '</table>'+
          '</td>'+
        '</tr>';

      $(tabla2).append(content_formula)

    }
    var nueva_orden = result.historia.ordenes.length;
    nueva_orden++

    $('#td').val(nueva_orden)
    $('#formula').val(nueva_orden)
  }
  //END ORDENES

  if( vista == 'paraclinicos' ){
    //id  historia_id td  solicitud fecha entidad profesional_medico  diagnosticos
    for( var pos in result.historia.paraclinicos ) {
      //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
      //result.historia.paraclinicos[pos].historia_id
      var fecha_formula = ''+
        '<tr class="row ver-formula-paciente" data-orden="'+result.historia.paraclinicos[pos].id+'" style="margin-bottom: 0px;">'+
          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.historia.paraclinicos[pos].solicitud+'</td>'+
          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.historia.paraclinicos[pos].fecha+'</td>'+
        '</tr>';
      $(tabla1).append(fecha_formula)

      var content_formula = ''+
        '<tr class="row" data-detalle-orden="'+result.historia.paraclinicos[pos].id+'" >'+
          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
            '<h5 style="padding-top:7px;">Entidad: '+result.historia.paraclinicos[pos].entidad.nombre_entidad+'</h5>'+
          '</td>'+
          '<td class="col-md-12" style="padding-bottom:0px">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-3">'+
                '<b>Formula:<br></b> '+result.historia.paraclinicos[pos].solicitud+'<br>'+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Fecha:</b> <br>'+result.historia.paraclinicos[pos].fecha+
              '</div>'+
              '<div class="col-md-6">'+
                '<b>Profesional Médico:</b> <br>'+result.historia.paraclinicos[pos].medico_especialista.nombre+
              '</div>'+
              '<div class="col-md-12">'+
                '<b>Diagnosticos:</b> <br>'+result.historia.paraclinicos[pos].diagnosticos+
              '</div>'+
            '</div>'+
          '</td>'+
          '<!-- Archivo Descargable -->'+
          '<td class="col-md-12" style="padding-bottom:0px;padding-top:0px;">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-12 text-center">'+
                '<a href="'+window.location.origin+'/descargar-paraclinico/'+result.historia.paciente_id+'/'+result.historia.paraclinicos[pos].historia_id+'/'+result.historia.paraclinicos[pos].id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
                  '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
                '</a>'+
              '</div>'+
            '</div>'+
          '</td>'+
        '</tr>';

      $(tabla2).append(content_formula)

    }
    var nueva_orden = result.historia.paraclinicos.length;
    nueva_orden++
    $('#p_td').val(nueva_orden)
    $('#solicitud').val(nueva_orden)
  }
  //END PARACLINICOS

  if( vista == 'incapacidades' ){
    for( var pos in result.historia.incapacidades ) {
      //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
      //result.historia.incapacidades[pos].historia_id
      var fecha_formula = ''+
        '<tr class="row ver-formula-paciente" data-orden="'+result.historia.incapacidades[pos].id+'" style="margin-bottom: 0px;" >'+
          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.historia.incapacidades[pos].incapacidad+'</td>'+
          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.historia.incapacidades[pos].fecha+'</td>'+
        '</tr>';
      $(tabla1).append(fecha_formula)

      var content_formula = ''+
        '<tr class="row" data-detalle-orden="'+result.historia.incapacidades[pos].id+'" >'+
          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
            '<h5 style="padding-top:7px;">Entidad: '+result.historia.incapacidades[pos].entidad.nombre_entidad+'</h5>'+
          '</td>'+
          '<td class="col-md-12" style="padding-bottom:0px">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-2">'+
                '<b>Incapacidad:<br></b> '+result.historia.incapacidades[pos].incapacidad+'<br>'+
              '</div>'+
              '<div class="col-md-2">'+
                '<b>Fecha:</b> <br>'+result.historia.incapacidades[pos].fecha+
              '</div>'+
              '<div class="col-md-2">'+
                '<b>Hora:</b> <br>'+result.historia.incapacidades[pos].hora+
              '</div>'+
              '<div class="col-md-6">'+
                '<b>Profesional Médico:</b> <br>'+result.historia.incapacidades[pos].medico_especialista.nombre+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Clase de Incapacidad:</b> <br>'+result.historia.incapacidades[pos].clase_incapacidad+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Tipo de Incapacidad:</b> <br>'+result.historia.incapacidades[pos].tipo_incapacidad+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Dias:</b> <br>'+result.historia.incapacidades[pos].dias+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Inicio:</b> <br>'+result.historia.incapacidades[pos].inicio+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Finalizacion:</b> <br>'+result.historia.incapacidades[pos].finalizacion+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Días en Letras</b> <br>'+result.historia.incapacidades[pos].txt_dias+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Diagnostico:</b> <br>'+result.historia.incapacidades[pos].diagnostico+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Descripcion:</b> <br>'+result.historia.incapacidades[pos].descripcion+
              '</div>'+
            '</div>'+
          '</td>'+
          '<!-- Archivo Descargable -->'+
          '<td class="col-md-12" style="padding-bottom:0px;padding-top:0px;">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-12 text-center">'+
                '<a href="'+window.location.origin+'/descargar-incapacidad/'+result.historia.paciente_id+'/'+result.historia.incapacidades[pos].historia_id+'/'+result.historia.incapacidades[pos].id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
                  '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
                '</a>'+
              '</div>'+
            '</div>'+
          '</td>'+
        '</tr>';

      $(tabla2).append(content_formula)

    }
    var nueva_orden = result.historia.incapacidades.length;
    nueva_orden++
    $('#i_td').val(nueva_orden)
    $('#incapacidad').val(nueva_orden)
  }
  //END INCAPACIDADES

  //Referencias
  if( vista == 'referencias' ){
    for( var pos in result.historia.referencias ) {
      //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
      //result.historia.referencias[pos].historia_id
      var fecha_formula = ''+
        '<tr class="row ver-formula-paciente" data-orden="'+result.historia.referencias[pos].id+'" style="margin-bottom: 0px;" >'+
          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.historia.referencias[pos].remision+'</td>'+
          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.historia.referencias[pos].fecha+'</td>'+
        '</tr>';
      $(tabla1).append(fecha_formula)

      var content_formula = ''+
        '<tr class="row" data-detalle-orden="'+result.historia.referencias[pos].id+'" >'+
          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
            '<h5 style="padding-top:7px;">Entidad: '+result.historia.referencias[pos].entidad.nombre_entidad+'</h5>'+
          '</td>'+
          '<td class="col-md-12" style="padding-bottom:0px">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-2">'+
                '<b>Remision:<br></b> '+result.historia.referencias[pos].remision+'<br>'+
              '</div>'+
              '<div class="col-md-2">'+
                '<b>Fecha:</b> <br>'+result.historia.referencias[pos].fecha+
              '</div>'+
              '<div class="col-md-2">'+
                '<b>Hora:</b> <br>'+result.historia.referencias[pos].hora+
              '</div>'+
              '<div class="col-md-6">'+
                '<b>Profesional Médico:</b> <br>'+((result.historia.referencias[pos].profesional_medico != undefined) ? result.historia.referencias[pos].profesional_medico.nombre :"" )+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Especialidad:</b> <br>'+result.historia.referencias[pos].especialidad+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Diagnostico:</b> <br>'+result.historia.referencias[pos].diagnostico+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Enfermedad Actual:</b> <br>'+result.historia.referencias[pos].enfermedad_actual+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Fecha:</b> <br>'+result.historia.referencias[pos].contra+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Hallazgos:</b> <br>'+result.historia.referencias[pos].hallazgos+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Examenes:</b> <br>'+result.historia.referencias[pos].examenes+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Tratamiento:</b> <br>'+result.historia.referencias[pos].tratamiento+
              '</div>'+
            '</div>'+
          '</td>'+
          '<!-- Archivo Descargable -->'+
          '<td class="col-md-12" style="padding-bottom:0px;padding-top:0px;">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-12 text-center">'+
                '<a href="'+window.location.origin+'/descargar-referencia/'+result.historia.paciente_id+'/'+result.historia.referencias[pos].historia_id+'/'+result.historia.referencias[pos].id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
                  '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
                '</a>'+
              '</div>'+
            '</div>'+
          '</td>'+
        '</tr>';

      $(tabla2).append(content_formula)

    }
    var nueva_orden = result.historia.referencias.length;
    nueva_orden++
    $('#r_td').val(nueva_orden)
    $('#remision').val(nueva_orden)
  }
  //END REFERENCIAS

  //evoluciones
  if( vista == 'evoluciones' ){
    for( var pos in result.historia.evoluciones ) {
      //AGREGAR DATOS DE ORDEN EN MODAL DE CONSULTAS
      //result.referencias[pos].historia_id
      var fecha_formula = ''+
        '<tr class="row ver-formula-paciente" data-orden="'+result.historia.evoluciones[pos].id+'" style="margin-bottom: 0px;" >'+
          '<td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'+result.historia.evoluciones[pos].control+'</td>'+
          '<td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'+result.historia.evoluciones[pos].fecha+'</td>'+
        '</tr>';
      $(tabla1).append(fecha_formula)

      var content_formula = ''+
        '<tr class="row" data-detalle-orden="'+result.historia.evoluciones[pos].id+'" >'+
          '<td class="col-md-12 text-center blue darken-2 text-white" style="padding:0px">'+
            '<h5 style="padding-top:7px;">Entidad: '+result.historia.evoluciones[pos].entidad.nombre+'</h5>'+
          '</td>'+
          '<td class="col-md-12" style="padding-bottom:0px">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-2">'+
                '<b>Control:<br></b> '+result.historia.evoluciones[pos].control+'<br>'+
              '</div>'+
              '<div class="col-md-2">'+
                '<b>Fecha:</b> <br>'+result.historia.evoluciones[pos].fecha+
              '</div>'+
              '<div class="col-md-2">'+
                '<b>Hora:</b> <br>'+result.historia.evoluciones[pos].hora+
              '</div>'+
              '<div class="col-md-6">'+
                '<b>Profesional Médico:</b> <br>'+((result.historia.evoluciones[pos].profesional_medico != undefined) ? result.historia.evoluciones[pos].profesional_medico.nombre :"" )+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Subjetivo:</b> <br>'+result.historia.evoluciones[pos].subjetivo+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Objetivo:</b> <br>'+result.historia.evoluciones[pos].objetivo+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Descripcion:</b> <br>'+result.historia.evoluciones[pos].descripcion+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Observaciones:</b> <br>'+result.historia.evoluciones[pos].observaciones+
              '</div>'+
              '<div class="col-md-3">'+
                '<b>Intervencion:</b> <br>'+result.historia.evoluciones[pos].intervencion+
              '</div>'+
            '</div>'+
          '</td>'+
          '<!-- Archivo Descargable -->'+
          '<td class="col-md-12" style="padding-bottom:0px;padding-top:0px;">'+
            '<div class="row" style="margin-bottom: 0px;">'+
              '<div class="col-md-12 text-center">'+
                '<a href="'+window.location.origin+'/descargar-evolucion/'+result.historia.paciente_id+'/'+result.historia.evoluciones[pos].historia_id+'/'+result.historia.evoluciones[pos].id+'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">'+
                  '<i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>'+
                '</a>'+
              '</div>'+
            '</div>'+
          '</td>'+
        '</tr>';

      $(tabla2).append(content_formula)

    }
    var nueva_orden = result.historia.evoluciones.length;
    nueva_orden++
    $('#e_td').val(nueva_orden)
    $('#e_control').val(nueva_orden)
  }
  //END EVOLUCIONES

  $(tabla2+' > tr').hide()
  $(tabla2+' > tr:nth-child(1)').show()
  $(tabla1+' > tr.ver-formula-paciente:nth-child(1)').addClass('active')
  $(tabla1+' .ver-formula-paciente').click(function(){
    $(tabla1+' > tr.ver-formula-paciente').removeClass('active')
    $(this).addClass('active')
    $(tabla2+' > tr').hide()
    var id_tab = $(this).data('orden')
    $(tabla2+' tr[data-detalle-orden="'+id_tab+'"]').show()
  })

}