# php-class-check-recaptcha
PHP Class for check Google reCaptcha V2

<p>Example:</p>

    include('_class.recaptcha.php');
    $recaptcha = new recaptcha($_POST['g-recaptcha-response'],'recaptchaSekretKey');
    $response = $recaptcha->checkRecaptcha();
    if($response){
      //You are a man!
    }else{
      //You are a robot!
    }
