function btnBlock(btn,block=true){
    if(block){$(btn).addClass("disabled");}else{$(btn).removeClass("disabled");}
}


function alertDivRetorno(ele='',classe='light',erro_msg='erro',btn=false){
    $(ele).attr("class","");
    $(ele).addClass("text-center alert alert-"+classe);
    $(ele).html(erro_msg);
    if(btn){
        btnBlock(btn,true);
    }
}

let formLogin= $("#form-login");
let divRetorno= "#div-retorno";
let btnLogin='.btn-login';

$(formLogin).submit(function(event){
    event.preventDefault();

    alertDivRetorno(divRetorno,'light','<img src="'+base_url+'/assets/images/spiner.gif" width="45px"> Logando...',btnLogin);

    $.post(base_url+"/login/logar", formLogin.serialize(),  function(retorno) {
        $("#div-retorno").html(retorno);
    }).fail(function(erro){
        var erro_msg='ERRO CODE '+erro.status+'<br><p>'+erro.statusText+'</p>';
        alertDivRetorno(divRetorno,'danger',erro_msg);
        btnBlock(btnLogin,false);
    });
    
});