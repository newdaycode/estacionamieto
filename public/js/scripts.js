(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);



$(function(){
    var actualizarHora = function(){
        var fecha = new Date(),
          hora = fecha.getHours(),
          minutos = fecha.getMinutes(),
          segundos = fecha.getSeconds(),
          dia = fecha.getDate(),
          mes = fecha.getMonth(),
          anio = fecha.getFullYear(),
          ampm;
      
        var $pHoras = $("#horas"),
          $pSegundos = $("#segundos"),
          $pMinutos = $("#minutos"),
          $pAMPM = $("#ampm"),
          $pDia = $("#dia"),
          $pMes = $("#mes"),
          $pAnio = $("#anio");

        var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
      
        $pDia.text(dia);
        $pMes.text(meses[mes]);
        $pAnio.text(anio);
        if(hora>=12){
            hora = hora - 12;
            ampm = "PM";
        }else{
            ampm = "AM";
        }
        if(hora == 0){
            hora = 12;
        }
        if(hora<10){$pHoras.text("0"+hora)}else{$pHoras.text(hora)};
        if(minutos<10){$pMinutos.text("0"+minutos)}else{$pMinutos.text(minutos)};
        if(segundos<10){$pSegundos.text("0"+segundos)}else{$pSegundos.text(segundos)};
        $pAMPM.text(ampm);
    };
    
    actualizarHora();
    var intervalo = setInterval(actualizarHora,1000);
});
