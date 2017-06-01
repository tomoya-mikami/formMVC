/*jquery使用*/
window.onload = function(){

    var $nameID=$('#name');
    var $adressID=$('#adress');
    var $telID=$('#tel');
    var $contentID=$('#content');

    var getName = $nameID.attr('data-name');
    var getAdress = $adressID.attr('data-adress');
    var getTel = $telID.attr('data-tel');
    var getContent = $contentID.attr('data-content');

    /*コンソールチェック*/
    console.log(getName);
    console.log(getAdress);
    console.log(getTel);
    console.log(getContent);

    if(getName!=0){
        $nameID.children('input').attr("value",getName);
    }

    if(getAdress!=0){
        $adressID.children('input').attr("value",getAdress);
    }

    if(getTel!=0){
        $telID.children('input').attr("value",getTel);
    }

    if(getContent!=0){
        $contentID.children('textarea').text(getContent);
    }
}