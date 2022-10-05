var idleTime = 0;
var start = new Date();
var end;
var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
// if mousemove, a keypressed or a mouse click events fired
$(document).on('mousemove keydown click', function() {
    end = new Date();
    idleTime = (end.getTime() - start.getTime()) /1000;
    if ( idleTime > 1800 ) { 
        window.location.href="index.php";
    }
}); 

/*var estaciones =  {'Uva':97.5, 'Poderoza':107.7, 'Invasora':98.9};
console.log(estaciones)*/

$('#errorname').hide();
$('#errorAP').hide();
$('#errorAM').hide();
$('#errorD').hide();
$('#errorE').hide();
$('#errorC').hide();
$('#erroraname').hide();
$('#erroraAP').hide();
$('#erroraAM').hide();
$('#erroraD').hide();
$('#erroraE').hide();
$('#erroraC').hide();
$('#errorF').hide();
$('#fileUser').hide();
var options = {
    height: 400,
    width: 400
};

$(document).ready(function () {
    var Iduser = $('#ValIdUser').val();
    $.ajax({
        type: 'POST',
        url: "ajax.php",
        data: {
            'op': 'ListaUsuarios'
        },
        success: function (data) {
            var valores = $.parseJSON(data)
            //valores = valores.reverse();
            for (i = 0; i < valores.length; i++) {
                $('#bodyInformativo').append(
                    "<tr>" +
                    "<td id=" + "camposnuevos" + " style=" + "'color: #0040FF'" + ">" + valores[i].Id + "</td>" +
                    "<td id=" + "camposnuevos" + " style=" + "'color: #0040FF'" + ">" + valores[i].nombre + ' ' + valores[i].apellidoPaterno + ' ' + valores[i].apellidoMaterno + "</td>" +
                    "<td id=" + "camposnuevos" + " class='text-uppercase' style=" + "'color: #0040FF'" + ">" + valores[i].email + "</td>" +
                    "<td id=" + "camposnuevos" + " style=" + "'color: #0040FF'" + ">" + valores[i].domicilio + "</td>" +
                    "<td id=" + "camposnuevos" + "><a href='#' class='btn btn-primary verinfo' value=" + valores[i].Id + " data-bs-toggle=" + "modal" + " data-bs-target=" + "#viewinfo" + "><i class='far fa-id-badge'></i></a></td>" +
                    "<td id=" + "camposnuevos" + "><a href='#' class='btn btn-primary verinfo' value=" + valores[i].Id + " data-bs-toggle=" + "modal" + " data-bs-target=" + "#viewinfo" + ">uva</a></td>" +
                    "<td id=" + "camposnuevos" + "><a href='#' class='btn btn-success editarbtn' value=" + valores[i].Id + " data-bs-toggle=" + "modal" + " data-bs-target=" + "#editardatos" + "><i class='fas fa-pencil-alt'></i></a></td>" +
                    "<td id=" + "camposnuevos" + "><a href='#' class='btn btn-danger eliminarbtn' value=" + valores[i].Id + "><i class='fas fa-trash'></i></a></td>" +
                    "<tr>"
                );
            }
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });
    
    /*$.ajax({
        type: 'POST',
        url: "ajax.php",
        data: {
            'op': 'ShowInfo',
            'Id': Iduser
        },
        success: function (data) {
            var src = 'data:image/png;base64,' + data + '';
            $('#ImgUser').attr('src',src);
            $('.zoom').hover(function() {
                $(this).addClass('transition');
            }, function() {
                $(this).removeClass('transition');
            });
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });*/
});

$('#email').on('change', function(){
    var email = $(this).val();
    if(regex.test(email) === false)
    {
        $('#errorE').show();
        $('#email').addClass('border-danger');
        $('#errorE').text('Email Incorrecto');
       
    }else{
        $('#errorE').text('Favor de Ingresar el Email');
        $('#errorE').hide();
        $('#email').removeClass('border-danger');
        
    }
});

$('#aemail').on('change',function(){
    var email = $(this).val();
    if(regex.test(email) === false)
    {
        $('#erroraE').show();
        $('#aemail').addClass('border-danger');
        $('#erroraE').text('Email Incorrecto');
       
    }else{
        $('#erroraE').text('Favor de Ingresar el Email');
        $('#erroraE').hide();
        $('#aemail').removeClass('border-danger');
        
    }
});

/*$('#Guardar').click(function () {
    
    
    $(this).html('<div class="spinner-border text-light spinner-border-sm" role="status">'+
    '<span class="visually-hidden">Loading...</span>'+
  '</div>');
    var form = $('#formNuevoEmpleado').serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    var patronCP = /(^([0-9]{5,5})|^)$/;
    var codigopostal = document.getElementById("codigopostal");
    if (!(patronCP.test(form.codigopostal)) || form['codigopostal'] =="") {
        console.log(form)
        codigopostal.setCustomValidity('Código postal inválido');
        $(this).text('Guardar');
       return false;
    }
   console.log(form.codigopostal);
    //return false;
    
    //console.log(form);
    if (form['nombre'] == "" || form['apellidoPaterno'] == "" || form['apellidoMaterno'] == "" || (form['email'] == "" || regex.test(form['email']) === false) || form['domicilio'] == "" || form['password'] == "" ) {
        // validaciones por campo Nombre
        $(this).text('Guardar');
        if (form['nombre'] == "") {
            $('#errorname').show();
            $('#nombre').addClass('border-danger');
        } else {
            $('#errorname').hide();
            $('#nombre').removeClass('border-danger');
        }
        // validaciones por campo Nombre
        if (form['apellidoPaterno'] == "") {
            $('#errorAP').show();
            $('#apellidoPaterno').addClass('border-danger');

        } else {
            $('#errorAP').hide();
            $('#apellidoPaterno').removeClass('border-danger');
        }
        // validaciones por campo Nombre
        if (form['apellidoMaterno'] == "") {
            $('#errorAM').show();
            $('#apellidoMaterno').addClass('border-danger');

        } else {
            $('#errorAM').hide();
            $('#apellidoMaterno').removeClass('border-danger');
        }
        // validaciones por campo Email
        if (form['email'] == "") {
            $('#errorE').show();
            $('#email').addClass('border-danger');
            $('#errorE').text('Favor de Ingresar el Email');

        } else if(regex.test(form['email']) === false){
            $('#errorE').show();
            $('#email').addClass('border-danger');
            $('#errorE').text('Email Incorrecto');
        }
        else{
            $('#errorE').hide();
            $('#email').removeClass('border-danger');
        }
        // validaciones por campo Domicilio
        if (form['domicilio'] == "") {
            $('#errorD').show();
            $('#domicilio').addClass('border-danger');

        } else {
            $('#errorD').hide();
            $('#domicilio').removeClass('border-danger');
        }
        // validaciones por campo Nombre
        if (form['password'] == "") {
            $('#errorC').show();
            $('#password').addClass('border-danger');

        } else {
            $('#errorC').hide();
            $('#password').removeClass('border-danger');
        }
        $(this).text('Guardar');
        return false;
    } else {
        $('#errorname').hide();
        $('#nombre').removeClass('border-danger');
        $('#errorAP').hide();
        $('#apellidoPaterno').removeClass('border-danger');
        $('#errorAM').hide();
        $('#apellidoMaterno').removeClass('border-danger');
        $('#errorE').hide();
        $('#email').removeClass('border-danger');
        $('#errorD').hide();
        $('#domicilio').removeClass('border-danger');
        $('#errorC').hide();
        $('#password').removeClass('border-danger');
    }

    $.ajax({
        type: 'POST',
        url: "ajax.php",
        data: form,
        success: function (data) {
            if (data == 'true') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro Guardado Correctamente.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function () {
                    location.reload();
                })
            }
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });
});*/

$(document).on('click', '.eliminarbtn', function () {
    Idseleccionado = $(this).attr('value');
    //console.log(Idseleccionado);
    Swal.fire({
        title: 'Confirmación',
        text: "¿Está seguro que quiere eliminar este Usuario?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "ajax.php",
                data: {
                    'op': 'EliminarUsuario',
                    'Id': Idseleccionado
                },
                success: function (data) {
                    console.log(data)
                    if (data == 'true') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Registro Eliminado Correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function () {
                            location.reload();
                        })
                    }
                },
                error: function () {
                    alert('Algo salio Mal :(')
                }
            });
        }
    })
});

$(document).on('click', '.editarbtn', function () {
    Idseleccionado = $(this).attr('value');
    $.ajax({
        type: 'POST',
        url: "ajax.php",
        data: {
            'op': 'MostrarDatos',
            'Id': Idseleccionado
        },
        success: function (data) {
            var valores = $.parseJSON(data);         
            $('#id').val(valores[0]);
            $('#anombre').val(valores[2]);
            $('#aapellidoMaterno').val(valores[4]);
            $('#aapellidoPaterno').val(valores[3]);
            $('#adomicilio').val(valores[6]);
            $('#aemail').val(valores[1]);
            $('#NombreUser').text(' ' + valores[2] + ' ' + valores[3]);
            $('#ExisteImage').val(valores[7])
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });
});

$('#editar').click(function () {
    $(this).html('<div class="spinner-border text-light spinner-border-sm" role="status">'+
    '<span class="visually-hidden">Loading...</span>'+
  '</div>');
    var form = $('#formActEmpleado').serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    var imagen = $('#imagenuser')[0].files[0];
    var user_id = form['id'];
    if(global == 1)
    {
        var GSAVE = $('#ExisteImage').val();
        var imagen = $('#imagenuser')[0].files[0];
        var fd = new FormData();
    
        fd.append('file', imagen);
        fd.append('user_id', user_id);
        fd.append('op', 'SaveFile');
    }
    
    

    if (form['anombre'] == "" || form['aapellidoPaterno'] == "" || form['aapellidoMaterno'] == "" || (form['aemail'] == "" || regex.test(form['aemail']) === false) || form['adomicilio'] == "" || ($('#imagenuser').val() === "" && global==1)) {
        // validaciones por campo Nombre
        $(this).text('Editar');
        if (form['anombre'] == "") {
            $('#erroraname').show();
            $('#anombre').addClass('border-danger');
        } else {
            $('#erroraname').hide();
            $('#anombre').removeClass('border-danger');
        }
        // validaciones por campo Apellido Paterno
        if (form['aapellidoPaterno'] == "") {
            $('#erroraAP').show();
            $('#aapellidoPaterno').addClass('border-danger');

        } else {
            $('#erroraAP').hide();
            $('#aapellidoPaterno').removeClass('border-danger');
        }
        // validaciones por campo Nombre
        if (form['aapellidoMaterno'] == "") {
            $('#erroraAM').show();
            $('#aapellidoMaterno').addClass('border-danger');

        } else {
            $('#erroraAM').hide();
            $('#aapellidoMaterno').removeClass('border-danger');
        }
        // validaciones por campo Email
        if (form['aemail'] == "") {
            $('#erroraE').show();
            $('#aemail').addClass('border-danger');

        } else if(regex.test(form['aemail']) === false){
            $('#erroraE').show();
            $('#aemail').addClass('border-danger');
            $('#erroraE').text('Email Incorrecto');
        }else {
            $('#erroraE').hide();
            $('#aemail').removeClass('border-danger');
        }
        // validaciones por campo Domicilio
        if (form['adomicilio'] == "") {
            $('#erroraD').show();
            $('#adomicilio').addClass('border-danger');

        } else {
            $('#errorD').hide();
            $('#domicilio').removeClass('border-danger');
        }
        // validaciones por campo Imagen
        if ($('#imagenuser').val() === "" && global==1) {
            //console.log('Funciono')
            $('#errorF').show();
        } else {
            $('#errorF').hide();
        }

        return false;
    } else {
        $('#erroraname').hide();
        $('#anombre').removeClass('border-danger');
        $('#erroraAP').hide();
        $('#aapellidoPaterno').removeClass('border-danger');
        $('#erroraAM').hide();
        $('#aapellidoMaterno').removeClass('border-danger');
        $('#erroraE').hide();
        $('#aemail').removeClass('border-danger');
        $('#erroraD').hide();
        $('#adomicilio').removeClass('border-danger');
    }

    $.ajax({
        type: 'POST',
        url: "ajax.php",
        data: form,
        success: function (data) {
            if(global == 1){
                if (data == 'true') {
                    $.ajax({
                        type: 'POST',
                        url: "ajax.php",
                        data: fd,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            if (data != 'false') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Registro Actualizado Correctamente.',
                                    showConfirmButton: false,
                                    timer: 2500
                                }).then(function () {
                                    $(this).text('Editar');
                                    location.reload();
                                    //console.log(data)
                                })
                            } else {
                                console.log(data);
                            }
                        },
                        error: function () {
                            alert('Algo salio Mal :(')
                        }
                    });
                } else {
                    console.log(data);
                }
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro Actualizado Correctamente.',
                    showConfirmButton: false,
                    timer: 2500
                }).then(function () {
                    $(this).text('Editar');
                    location.reload();
                  //console.log(data);
                })
            }
           
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });
});

$(document).on('click', '.verinfo', function () {
    var valseleccionado = $(this).attr('value');
    // console.log(valseleccionado);
    /*$.ajax({
        type: 'POST',
        url: "ajax.php",
        data: {
            'op': 'ShowInfo',
            'Id': valseleccionado
        },
        success: function (data) {
            $('.centrador').html('<img id="imagen" class="zoom" src="data:image/png;base64,' + data + '" />');
            $('.zoom').hover(function() {
                $(this).addClass('transition');
            }, function() {
                $(this).removeClass('transition');
            });
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });*/
    $.ajax({
        type: 'POST',
        url: "ajax.php",
        data: {
            'op': 'MostrarDatos',
            'Id': valseleccionado
        },
        success: function (data) {
            var valores = $.parseJSON(data);
            $('#viewname').text(' ' + valores[2] + ' ' + valores[3] + ' ' + valores[4]);
            $('#viewD').text(valores[6]);
            $('#viewE').text(valores[1]);         
            $('#UserExportpdf').val(valores[0]); 
            var link = 'pdf.php?user_export='+valores[0]+'';
            $('.centrador').html('<img id="imagen" class="zoom" src="data:image/png;base64,' + valores[7] + '" />');
            $('#exportarpdf').attr('href',link); 
        },
        error: function () {
            alert('Algo salio Mal :(')
        }
    });
});

$('#exportarpdf').click(function(){
    $('#exportarpdf').blur();
}); 
var global = 0;
$('#NoCargarImagen').click(function(){
    if($('#NoCargarImagen').is(':checked')){
        $('#fileUser').hide();
        global = 0;
    }
});

$('#CargarImagen').click(function(){
    if($(this).is(':checked')){
        $('#fileUser').show();
        global = 1;
    }
});



/// Quitar error en Campo de3 Formulario Actualizar Usuario
$('#anombre').keyup(function () {
    $('#erroraname').hide();
    $('#anombre').removeClass('border-danger');
});
$('#aapellidoPaterno').keyup(function () {
    $('#erroraAP').hide();
    $('#aapellidoPaterno').removeClass('border-danger');
});
$('#aapellidoMaterno').keyup(function () {
    $('#erroraAM').hide();
    $('#aapellidoMaterno').removeClass('border-danger');
});
$('#aemail').keyup(function () {
    $('#erroraE').hide();
    $('#aemail').removeClass('border-danger');
});
$('#adomicilio').keyup(function () {
    $('#erroraD').hide();
    $('#adomicilio').removeClass('border-danger');
});
/// Quitar error en Campo de3 Formulario Guardar Usuario
$('#nombre').keyup(function () {
    $('#errorname').hide();
    $('#nombre').removeClass('border-danger');
});
$('#apellidoPaterno').keyup(function () {
    $('#errorAP').hide();
    $('#apellidoPaterno').removeClass('border-danger');
});
$('#apellidoMaterno').keyup(function () {
    $('#errorAM').hide();
    $('#apellidoMaterno').removeClass('border-danger');
});
$('#email').keyup(function () {
    $('#errorE').hide();
    $('#email').removeClass('border-danger');
});
$('#domicilio').keyup(function () {
    $('#errorD').hide();
    $('#domicilio').removeClass('border-danger');
});
$('#password').keyup(function () {
    $('#errorC').hide();
    $('#password').removeClass('border-danger');
});


$('#editardatos').on('hidden.bs.modal', function (event) {
    $('#erroraname').hide();
    $('#anombre').removeClass('border-danger');
    $('#erroraAP').hide();
    $('#aapellidoPaterno').removeClass('border-danger');
    $('#erroraAM').hide();
    $('#aapellidoMaterno').removeClass('border-danger');
    $('#erroraE').hide();
    $('#aemail').removeClass('border-danger');
    $('#erroraD').hide();
    $('#adomicilio').removeClass('border-danger');
    $('#errorF').hide();
  })

  $('#agregardatos').on('hidden.bs.modal', function (event) {
    $('#errorname').hide();
    $('#nombre').removeClass('border-danger');
    $('#errorAP').hide();
    $('#apellidoPaterno').removeClass('border-danger');
    $('#errorAM').hide();
    $('#apellidoMaterno').removeClass('border-danger');
    $('#errorE').hide();
    $('#email').removeClass('border-danger');
    $('#errorD').hide();
    $('#domicilio').removeClass('border-danger');
    $('#errorC').hide();
    $('#password').removeClass('border-danger');
  })
  $('#imagenuser').change(function(){
      var img = $(this).val();
      if(img != "")
      {
        $('#errorF').hide();
      }
  });

/// Validaciones de Codigo Postal
    $('#codigopostal').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#codigopostal').change(function() {
        let value = this.value;
        var patronCP = /(^([0-9]{5,5})|^)$/;
        if (!(patronCP.test(value))) {
            this.setCustomValidity('Código postal inválido');
            return false;
        }
    });

