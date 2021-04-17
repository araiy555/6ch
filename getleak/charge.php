<?php
// ダウンロードしたStripeのPHPライブラリのinit.phpを読み込む
require_once('stripe-php-master/init.php');

// APIのシークレットキー
\Stripe\Stripe::setApiKey('sk_test_ULPUmq7te0UKoUpBypZ04TBW');
//4242424242424242
$chargeId = null;

try {
    // (1) オーソリ（与信枠の確保）
    $token = $_POST['stripeToken'];
    $charge = \Stripe\Charge::create(array(
        'amount' => 100,
        'currency' => 'jpy',
        'description' => 'test',
        'source' => $token,
        'capture' => false,
    ));
    $chargeId = $charge['id'];

    // (2) 注文データベースの更新などStripeとは関係ない処理
    // :
    // :
    // :

    // (3) 売上の確定
    $charge->capture();

    // 購入完了画面にリダイレクト
    header("Location: /complete.html");
    exit;
} catch(Exception $e) {
    if ($chargeId !== null) {
        // 例外が発生すればオーソリを取り消す
        \Stripe\Refund::create(array(
            'charge' => $chargeId,
        ));
    }

    // エラー画面にリダイレクト
    header("Location: /error.html");
    exit;
}
?>
