$.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    type: 'post',
    dataType: 'json',
    url: '{{ route("registros.store") }}',
    data: {
        '_token': $('input[name=_token]').val(),
        'folio_contrato': $('#folio_contrato').val(),
        'apellido_paterno': $('#apellido_paterno').val(),
        'apellido_materno': $('#apellido_materno').val(),
        'nombre': $('#nombre').val()
    },
    beforeSend: function () {
        console.log('bloqueo botones');
    },
    complete: function () {
        console.log('desbloqueo botones');
    },
    success: function (response) {
       console.log('ok!');
    },
    error: function (jqXHR) {
        console.log('boo!');
    }
});