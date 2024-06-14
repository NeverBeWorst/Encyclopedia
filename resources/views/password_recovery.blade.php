@extends('layout.app')

@section('style')
{{asset('')}}
@endsection

@section('pagename', 'Авторизация')

@section('content')
<section>
    
    <?php
        $tfa = new RobThree\Auth\TwoFactorAuth('RobThree TwoFactorAuth');
        $secret = $tfa->createSecret();
        echo chunk_split($secret, 4, ' ');
        $code = $tfa->getCode($secret);
        echo "<br>";
        echo $code;
        if ($tfa->verifyCode($secret, $code ) === true) {
            echo " <br><span>OK</span>";
        }
        else {
            echo " <br><span>не</span>";
        }
    ?>
</section>
@endsection
