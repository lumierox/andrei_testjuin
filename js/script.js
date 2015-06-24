function cree_xhr(){
    var sortie_xhr;
    if(window.XMLHttpRequest){
        sortie_xhr = new XMLHttpRequest();
        if(sortie_xhr.overrideMimeType){
            sortie_xhr.overrideMimeType('text/xml');
        }
    }else{
        if(window.ActiveXObjet){
            try{
                sortie_xhr= new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                try{
                    sortie_xhr= new ActiveXObject("Microsoft.XMLHTTP");
                }catch(e){
                    sortie_xhr=null;
                }
            }
        }
    }
    return sortie_xhr;
};


//EXEMPLE
function envoye_ajax(value,table,colonne,condition){
    var req_xhr = cree_xhr();
    var reponse = 'false';
    if (req_xhr===null){
        alert("Votre navigateur ne supporte pas Ajax");
    }
    else{
        
        req_xhr.open('POST',"./includes/envoyeAjax.php",true);
        req_xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        
        req_xhr.onreadystatechange = function(){
            
            if (req_xhr.readyState===4 && req_xhr.status === 200) {
               
                console.log(req_xhr.responseText);
                reponse = value;
            }
        };
       
        req_xhr.send("value="+value+"&table="+table+"&colonne="+colonne+"&condition="+condition);
    }
    return (!reponse)? 'ko' :reponse;
}