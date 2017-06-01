<?php

//Controler

//開発モード(edit)か本番(production)か
$mode='edit';

//エラーをセットする変数
$error=array();

require_once("Form.php");
require_once("Mail.php");

$form = new Form();
$mail = new Mail();
//セッション開始
session_start();
//redirect用の関数
function redirect($pagename){
    $host=$_SERVER['HTTP_HOST'];
    $uri=dirname($_SERVER['PHP_SELF']);

    //https接続でなければ切り替える(公開するとき)
    if (empty($_SERVER['HTTPS']) && $mode=='production') {
        header("Location: https://{$host}/{$uri}/{$pagename}");
        exit;
    }else{
        header("Location: http://{$host}/{$uri}/{$pagename}");
        exit;
    }
}

//CSRF対策用の関数
//セット
function set_token(){
    $token = sha1(session_id());
    $_SESSION['token']=$token;
}
//チェック。エラーだとfalseを返す(公開するとき)
function check_token(){
    if($mode == 'edit'){
        return true;
    }
    if(!empty($_POST['token']) && $_POST['token'] == $_SESSION['token']){
        return true;
    }else{
        return false;
    }
    return false;
}

//モデルにセットする関数
function set_model($_subject,$_name,$_adress,$_tel,$_content,Form $f){

    $subjectFlag=$f->check_subject($_subject);
    $nameFlag=$f->check_name($_name);
    $adressFlag=$f->check_adress($_adress);
    $telFlag=$f->check_tel($_tel);
    $contentFlag=$f->check_content($_content);

    if($subjectFlag && $nameFlag && $adressFlag && $telFlag && $contentFlag){
        return true;    
    }else{
        $error=$f->get_error();
        foreach($error as $key => $value){
            $_SESSION[$key]=$value;
        }
        return false;
    }
}

//セッションにモデルをセットする関数
function set_session(Form $f){
    $_SESSION["subject"] = $f->get_subject();
    $_SESSION["name"] = $f->get_name();
    $_SESSION["adress"] = $f->get_adress();
    $_SESSION["tel"] = $f->get_tel();
    $_SESSION["content"] =$f->get_content();
}

//次のアクションを設定
if(array_key_exists("action",$_GET)){
    $action=$_GET["action"];
}else{
    $action="";
}

//sessionの初期化

set_session($form);

//modelにセットするための準備
$post=array();
if(!empty($_POST)){
    foreach($_POST as $key => $value){$post[$key]=$value;}
}
//htmlエスケープ
$post=$form->Html_escape($post);
//nullバイトチェック
$post=$form->Null_check($post);
//UTF-8に変換
$post=$form->Encod($post);

switch($action){
    //初期表示
    case "" :
        $_SESSION=array();
        session_regenerate_id();
        set_session($form);
        set_token(); 
        redirect("view_form.php");
        break; 
    case "check":
        if(check_token()){
            $_SESSION=array();
            session_regenerate_id();
            $_flag=set_model($post["subject"],$post["name"],$post["adress"],$post["tel"],$post["content"],$form);
            set_session($form);
            set_token();
            if($_flag){
                redirect("view_check.php");
            }else{
                redirect("view_form.php");
            }
        }else{
            redirect("view_error.php");
        }
        break;
    case "return":
        $_SESSION=array();
        session_regenerate_id();
        set_model($post["subject"],$post["name"],$post["adress"],$post["tel"],$post["content"],$form);
        set_session($form);
        set_token();
        redirect("view_form.php");
    case "send":
        if(check_token()){
            $_SESSION=array();
            session_regenerate_id();
            //制御文字の削除(今回は必要ではないが)
            $post=$form->Control_check($post);
            $mail->form_set($post["subject"],$post["name"],$post["adress"],$post["tel"],$post["content"]);
            $_SESSION["result"]=$mail->get_result_mess();
            set_token();
            redirect("view_result.php");
        }else{
            redirect("view_error.php");
        }
        break;
}
?>