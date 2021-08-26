
$(document).ready(function(){

  /* LECTOR DE IMAGEN A TEXTO
  Tesseract.recognize(
    'https://tesseract.projectnaptha.com/img/eng_bw.png',
    'eng',
    { logger: m => console.log(m) }
  ).then(({ data: { text } }) => {
    console.log(text);
  })
  */
  
	console.log('JSebas v0.6')

  //Iniciar Selects Genéricos
  $('select').formSelect()
  //iniciar Modal
  $('.modal').modal();
  //Iniciar tabs
  $('.tabs').tabs();
  //collapsible content
  $('.collapsible').collapsible();
  //tolltips
  $('.tooltipped').tooltip({'margin':0});

  //bug label select form
  bug_label_select_form()

  //bug for materialize selects
  bug_materialize_selects()

  //fixed bug tooltiped message dissapear
  fixed_tooltiped()

  //Funcion a ejecutar al cargar página completamente
  /*
  $(window).on("load", function(){
  });*/

  //Funcion para select de municipios y departamentos
  select_municipios_departamentos()

  setTimeout( function(){
    $('#app').removeClass('charge')
    $('.preloader-dev').hide()
    tables_fix_header()
    if( $('.modal-table').length > 0 ){
      tables_modal()
    }
  }, 100 )

});

function fixed_tooltiped(){
  $(document).click(function(){
    $('.material-tooltip').each(function(){
      $(this).css("visibility", "hidden");
    })
  })
}

function tables_modal(){
  $('.modal-table').each(function(i,obj){
    $(obj).addClass('move-'+i+'')
  })
  $('.modal-content-table').each(function(i,obj){
    $(obj).addClass('push-'+i+'')
  })
  $('.modal').each(function(i,obj){
    $('.move-'+i+'').appendTo('.push-'+i+'')
  })
}

function tables_fix_header(){
  $('.dev-table-sebas').each(function(i,obj){
    //head, fix
    var header_table = $(obj).find('thead').html()
    var n_rows = $(obj).find('th').length
    $(obj).find('.dev-table-head').append('<thead class="center dev-stick stik-'+i+'">'+header_table+'</thead>')
    for( var y = 1; y <= n_rows; y++ ){
      $('.stik-'+i+' > tr > th:nth-child('+y+')').width( $(obj).find('table thead tr th:nth-child('+y+')').width() )
    }
  })
}

function bug_label_select_form(){
  $('.select-wrapper').each(function(){
    $(this).parent('.input-field').children('label').addClass('cata-label')
  })
}

function bug_materialize_selects(){
	$('.select-dropdown li').click(function(){
  	if ( $(this).html() != '<span>...</span>' ){
  		$(this).parent().parent('ul').parent('.select-wrapper')
  			.children('input')
  			.css('border-bottom', '1.5px solid #4CAF50')
  	}else{
  		$(this).parent().parent('ul').parent('.select-wrapper')
  			.children('input')
  			.css('border-bottom', '1.5px solid green')
  	}
  })
}

function menu_desplegable(){
  if( $('.content-logo.altura-cero').length > 0 ){
    $('.content-logo').removeClass('altura-cero')
    $('.menu-button i').removeClass('rote')
    $('.menu-button').removeClass('paddd')
    $('.barras-del-menu').removeClass('animar')
    $('.btn-menu').removeClass( 'active' )
    setTimeout(function(){
      $('.content-logo').css('overflow', 'inherit')
    },500)
  }else{
    $('.content-logo').css('overflow', 'hidden')
    $('.content-logo').addClass('altura-cero')
    $('.menu-button i').addClass('rote')
    $('.menu-button').addClass('paddd')
    $('.barras-del-menu').addClass('animar')
    $('.btn-menu').addClass( 'active' )
  }
}

/*
mateolopz06@gmail.com
Mate-itu0611
*/

function materialice_datpicker(){
  /*
  //Datepiker
  inter_es = {
      cancel: 'Cancelar',
      clear: 'Limpiar',
      done:    'Ok',
      previousMonth:    '‹',
      nextMonth:    '›',
      months:    [
          'Enero',
          'Febrero',
          'Marzo',
          'Abril',
          'Mayo',
          'Junio',
          'Julio',
          'Agosto',
          'Septiembre',
          'Octubre',
          'Noviembre',
          'Diciembre'
      ],
      monthsShort:    [
          'Ene',
          'Feb',
          'Mar',
          'Abr',
          'May',
          'Jun',
          'Jul',
          'Ago',
          'Sep',
          'Oct',
          'Nov',
          'Dic'
      ],

      weekdays:    [
          'Domingo',
          'Lunes',
          'Martes',
          'Miércoles',
          'Jueves',
          'Viernes',
          'Sábado'
      ],

      weekdaysShort:    [
          'Dom',
          'Lun',
          'Mar',
          'Mié',
          'Jue',
          'Vie',
          'Sáb'
      ],

      weekdaysAbbrev:    ['D', 'L', 'M', 'M', 'J', 'V', 'S'],

  }; */

  /*funion getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }*/

  /*
  $('.datepicker').datepicker({
    i18n: inter_es,
    firstDay: 1,
    format: 'yyyy-mm-dd',
    dateFormat: 'yyyy-mm-dd',
    yearRange: "1950:2010",
    onSelect: function(i,obj){
      var id = $( $(this)[0].$el[0] ).attr('id')
      console.log( id )
      //almacenar id del input para obtener el valor de la fecha de nacimiento
      $('#'+id+'').addClass('close-edad')
    },
    onClose: function(i,obj){
      //recuperar id del input para el valor de la fecha de nacimiento
      var id = $('.close-edad').attr('id')
      //remover clase temporal de input
      $('#'+id+'').removeClass('close-edad')
      //fecha = 2019-07-10
      var fecha = $('#'+id+'').val()
      var edad = getAge(""+fecha+"")
      $('#edad').val(edad)
      $('#edad').addClass('valid')
      $('label[for="edad"]').addClass('active')
    }
  })
  */
}


function select_municipios_departamentos(){
  $('#depto').change(function(){
    var depto = $('#depto').val()
    $('#municipio option').remove()
    $('#municipio').append('<option value="">...</option>')
    $('#list-municipios option[data-depto="'+depto+'"]').each(function(i,obj){
      $(obj).clone().appendTo('#municipio')
    })
    $('#div-municipio').removeClass('hide')
    //inicializo la instancia select
    $('#municipio').formSelect()
  })
}