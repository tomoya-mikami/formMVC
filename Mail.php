<?php

//メールを送るモデル

class Mail{
    //管理者のメアド.コンストラクタで値のセット
    private $master;
    
    private $subject;
    private $name;
    private $adress;
    private $tel;
    private $content;

    //コンストラクタ
    function __construct(){
        //管理者のメアド
        $this->master="trymorecc@gmail.com";

        $this->subject="";
        $this->name="";
        $this->adress="";
        $this->tel="";
        $this->content="";
    }

    //管理者のセッター、ゲッター
    public function set_master($_master){
        $this->master=$_master;
    }
    public function get_master(){
        return $this->master;
    }

    //件名のセッター、ゲッター
    public function set_subject($_subject){
        $this->subject=$_subject;
    }
    public function get_subject(){
        return $this->subject;
    }

    //件名のセッター、ゲッター
    public function set_name($_name){
        $this->name=$_name;
    }
    public function get_name(){
        return $this->name;
    }

    //メールアドレスのセッター、ゲッター
    public function set_adress($_adress){
        $this->adress=$_adress;
    }
    public function get_adress(){
        return $this->adress;
    }

    //電話番号のセッター、ゲッター
    public function set_tel($_tel){
        $this->tel=$_tel;
    }
    public function get_tel(){
        return $this->tel;
    }

    //内容のセッター、ゲッター
    public function set_content($_content){
        $this->content=$_content;
    }
    public function get_content(){
        return $this->content;
    }

    public function form_set($_subject,$_name,$_adress,$_tel,$_content){
        $this->set_subject($_subject);
        $this->set_name($_name);
        $this->set_adress($_adress);
        $this->set_tel($_tel);
        $this->set_content($_content);
    }

    public function mail_send(){
        //文字指定
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        
        $send=$this->master.",".$this->adress;
        $_send_content=$this->content."\n".$this->name."さんからの連絡です。 tel:".$this->tel;
        $headder="From: ".$this->master;
        return mb_send_mail($send,$this->subject,$_send_content,$headder);
    }

    public function get_result_mess(){
        if($this->mail_send()){
            return "ご回答有り難うございます。確認のメールをお送りいたしました。";
        }else{
            return "メールの送信に失敗しました";
        }
    }
}
?>