<?php

//modelのクラス

class Form{

    private $subject;
    private $name;
    private $adress;
    private $tel;
    private $content;
    private $error;

    //コンストラクタ
    function __construct(){
        $this->subject="";
        $this->name="";
        $this->adress="";
        $this->tel="";
        $this->content="";
        $this->error=array();
    }

    //subjectのゲッター、セッター
    public function set_subject($_subject){
        $this->subject=$_subject;
    }
    public function get_subject(){
        return $this->subject;
    }

    //nameのゲッター、セッター
    public function set_name($_name){
        $this->name=$_name;
    }
    public function get_name(){
        return $this->name;
    }

    //adressのゲッター、セッター
    public function set_adress($_adress){
        $this->adress=$_adress;
    }
    public function get_adress(){
        return $this->adress;
    }

    //telのゲッター、セッター
    public function set_tel($_tel){
        $this->tel=$_tel;
    }
    public function get_tel(){
        return $this->tel;
    }

    //contentのゲッター、セッター
    public function set_content($_content){
        $this->content=$_content;
    }
    public function get_content(){
        return $this->content;
    }

    //error配列のゲッター、セッター。ゲッターはインデックス、値の順番
    public function set_error($key,$value){
        $this->error[$key]=$value;
    }
    public function get_error(){
        return $this->error;
    }

    //件名のチェック
    public function check_subject($_subject){
        switch($_subject){
            case "opinion":
                $this->set_subject("ご意見");
                return true;
                break;
            case "impression":
                $this->set_subject("ご感想");
                return true;
                break;
            case "other":
                $this->set_subject("その他");
                return true;
                break;
            case "":
                $this->set_error("error_subject","この項目は必須です");
                return false;
            default:
                $this->set_subject($_subject);
                return true;
        }
    }

    //名前のチェック
    public function check_name($_name){
        if($_name==""){
            $this->set_error("error_name","この項目は必須です");
            return false;
        }else{ 
            $this->set_name($_name);
            return true;
        }
    }

    //アドレスのチェック
    public function check_adress($_adress){
        if($_adress==""){
            $this->set_error("error_adress","この項目は必須です");
            return false;
        }
        if(filter_var($_adress,FILTER_VALIDATE_EMAIL)){
            $this->set_adress($_adress);
            return true;
        }else{
            $this->set_error("error_adress","※アドレスはinfo@example.comの形式で入力してください");
            $this->set_adress($_adress);
            return false;
        }
        return false;
    }

    //電話番号のチェック
    public function check_tel($_tel){
        if($_tel==""){
            $this->set_error("この項目は必須です");
            return false;
        }
        $pattern = '/\d{2,4}-\d{3,5}-\d{3,4}$/';
        if(preg_match($pattern,$_tel)==1){
            $this->set_tel($_tel);
            return true;
        }else{
            $this->set_error("error_tel","※電話番号はハイフンありで00-00-00の形式で入力してください");
            $this->set_tel($_tel);
            return false;
        }
    }

    //内容のチェック
    public function check_content($_content){
        if($_content==""){
            $this->set_error("error_content","この項目は必須です");
            return false;
        }else{
            $this->set_content($_content);
            return true;
        }
    }

    //HTMLエスケープを行う関数。仮に配列が引数の場合はすべて変換した配列を返す
    //エラーの場合はfalseを返す
    public function Html_escape($set){
        if(is_array($set)){
            foreach($set as $key => $value){
                $set[$key]=htmlspecialchars($value,ENT_QUOTES);
            }
            return $set;
        }else{
            return htmlspecialchars($set,ENT_QUOTES);
        }
        return false;
    }

    //nullバイト攻撃を防ぐ関数。仮に入力中に存在した場合nullに変換する
    //引数が配列の場合すべてチェックし、すべて変換する
    public function Null_check($set){
        if(is_array($set)){
            foreach($set as $key => $value){
                $set[$key]=str_replace("\0","",$set[$key]);
            }
            return $set;
        }else{
            return str_replace("\0","",$set);
        }
        return false;
    }

    //制御文字を削除する関数
    public function Control_check($set){
        return preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F\r\n]/', '', $set);
    }

    //文字をエンコードする関数(UTF-8)
    public function Encod($set){
        if(is_array($set)){
            foreach($set as $key => $value){
                $set[$key]=mb_convert_encoding($set[$key],"UTF-8","auto");
            }
            return $set;
        }else{
            return mb_convert_encoding($set[$key],"UTF-8","auto");
        }
        return false;
    }
}
?>