window.onscroll = function() {scrollNavBar()};

function scrollNavBar(){
	var header = document.getElementById("page-container");
	var sticky = header.offsetTop;

	if(window.pageYOffset > sticky){
		  $(".back-to-top").addClass("active");
	  }else{
      $(".back-to-top").removeClass("active");
	  }
}


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
});


$(".back-to-top").click(function(){
    targetOffset = $(".page-container").offset().top;
    $('html, body').animate({ 
        scrollTop: targetOffset - 100
    }, 200);
});
  
function modal_aviso(mensagem='Atenção',imagem=false,txt_btn='OK'){
    var html='<div class="text-center">';
    if(imagem !== false){
      html= html + '<img src="'+base_url+'/assets/images/'+imagem+'" width="75px"><br>';
    }
    html= html + mensagem + '</div>';
    $('#modal-aviso-corpo').html(html);
    if(txt_btn){
      $("#modal-aviso-btn").removeClass("d-none");
      $("#modal-aviso-btn").text(txt_btn);
    }else{
      $("#modal-aviso-btn").addClass("d-none");
    }
    
    $('#modal-aviso').modal('show');
}
  
function modal_confirmacao(mensagem='',funcao=''){
    $('#modal-confirmacao').modal('show');
  
    if($('#modal-confirmacao-msg')){
      $('#modal-confirmacao-msg').html(mensagem);
    }
    if(funcao!=''){
      $('#modal-confirmacao-btn-sim').attr('onclick',funcao);
      $('#modal-confirmacao-btn-sim').removeClass('d-none');
      $('#modal-confirmacao-title').text('CONFIRMAÇÃO');
      $('#modal-confirmacao-btn-nao').text('NÃO');
    }else{
      $('#modal-confirmacao-btn-sim').addClass('d-none');
      $('#modal-confirmacao-title').text('AVISO');
      $('#modal-confirmacao-btn-nao').text('OK');
    }
}

function btnBlock(btn,block=true){
  if(block){$(btn).addClass("disabled");}else{$(btn).removeClass("disabled");}
}

function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return 'R$ ' + negativeSign +
      (j ? i.substr(0, j) + thousands : '') +
      i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) +
      (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};