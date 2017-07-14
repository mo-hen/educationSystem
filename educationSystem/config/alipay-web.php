<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2017/6/26
 * Time: 下午5:21
 */

return [
    //应用ID,您的APPID。
    'app_id' => "2016080500169415",

    //商户私钥 不能用pkcs8.pem中的密钥！！！！！
    'merchant_private_key' => "MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC6bXzYuN+4Vws2v0ck/G2Bc1mNjIzZUTyTIXdAtkaoSoC5XNxyEejiy/2lgTGsJjI5zxh0C02g/uw0mzMT7/AsGAnFh7D/vtOOsa792enP22feznSbPbUC2w5CLszP1z6PFg7eSaCfIo8op/S93HH8MQzsHNleWLHXa0U1xbJGqp2ay0hBsFFArOfLlniR6uhfNDUTmoUnujtD0xrgZC0oSEEffow90XadlI5b20qFm8jCmRRgWrnvOcR+ImYG7mOGAwW6WnHQjkhHDX8YKl+edAUwa3tEClqoZQwxI6ju2zwlBoomrpsivxPv4ACjGtEsXuk56yM7EsT9lSI3uj4bAgMBAAECggEAbxxaUIC/NgsK7/JI4M5iJckuEqM2Pz+frsE/Zh49NohQ+ClUadgqySFzZ3T8ufF59eJsXJ1wAwhsl134r2VN67nX+RbKc2K0jFNyTHHYXL4TxkOeU/gPLkiI0wE5qJZM/tLSwcF4LeBXGpAf2hjNBtXlMcRv+T87n3ybn1TY0CxSnXxQU9Wt7J+jWbNn0eCQaW0NbV5aIBZPZDlOGajEDfFXcrPDfRAwN4IvBLhWzqAczAb+aDfmC0hcncjo7w0zJmflrb3IITpewGndpSZTVEteaXZiIxS0x3WlSMGGUnNEciGaex3lAkktnRW0xflz797CTbtGM3QMnpKc91ILQQKBgQDuo1ty3mTL7vhq0DvoKBwzzsPuzcHaHkkxaGQl1rDEFj7TEURU7D3ocSxyFsFn6biWNJXOnovAH0kibsm0MGlQ2pD2nDBltByEqvtcBWr8KclcoNHLS/GKqY394gEmwT1JLeoqDY0AHXI3asb4jZZ5YGkYeolaEBleD07k7uEOSQKBgQDH/bWilIQBQPFV/WFsOgoLJJN2yG4aYwTf16db4+5OhaP9pAf/eRYM9NbN6tEw7FNT0nAoepcsVgT6NeZ6yNIvqtKWCo7jZ26k/0tujkcojqfBxn3ZOUBfmyaQe4ANs0hIPKzE/8ciDvxg8t5z4vvm5tBkDXFv78ovuo4Zxnt5QwKBgQDg+d7oD2QlorhOMtyXhOD5sq+jPhXIpY7JZqorxhhF9Nbrs7ag/UtsDO4i7PMPHRfpe8/TyELmMFiJfrroBk/zausJo7w41bGhHXT1jyIKcvakPfUrXQBtgmYb+Oqu97TofcHqPXY1qo0YU7EbeJho+4x5CGTfJJhVxcbSK6a/CQKBgQDAj3raJeHMSzmUMDojuOZ+wCL0lhvdcEX7OWu9QIPuOyMhT1UcGPywUPaaomP1lTbOWKsBbrgsSk7UlB1tT/uBRhspuNTIBIk2eVGqC3hchq7kFziJdWSUKZFCQIeVqXAJjdJUhGq6Um+S8YZbUsx1EPzJuV/mBZ5JwnicPM4afQKBgHrEyCvVmC7+UUa0gGpc9VbA48IuObjrdQaWSyeKrZTVskraEAQrPtxkBD+oFoH8Y4f/p+iE9+ZrxWDfcisf4b+pZmpX9MPGtIE8Q73qrK9RcmED/rdoyNbFugHtc8K5HKo7XCm7v2vRY/Rgn9NPxnDcM9Jxt7IZNV+J/UtVqj9r",

    //异步通知地址
    'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

    //同步跳转
    'return_url' => "http://www.momo.com/home/shop/cart_complete",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAum182LjfuFcLNr9HJPxtgXNZjYyM2VE8kyF3QLZGqEqAuVzcchHo4sv9pYExrCYyOc8YdAtNoP7sNJszE+/wLBgJxYew/77TjrGu/dnpz9tn3s50mz21AtsOQi7Mz9c+jxYO3kmgnyKPKKf0vdxx/DEM7BzZXlix12tFNcWyRqqdmstIQbBRQKzny5Z4keroXzQ1E5qFJ7o7Q9Ma4GQtKEhBH36MPdF2nZSOW9tKhZvIwpkUYFq57znEfiJmBu5jhgMFulpx0I5IRw1/GCpfnnQFMGt7RApaqGUMMSOo7ts8JQaKJq6bIr8T7+AAoxrRLF7pOesjOxLE/ZUiN7o+GwIDAQAB",

    //支付时提交方式 true 为表单提交方式成功后跳转到return_url,
    //false 时为Curl方式 返回支付宝支付页面址址 自己跳转上去 支付成功不会跳转到return_url上， 我也不知道为什么，有人发现可以跳转请告诉 我一下 谢谢
    // email: 40281612@qq.com
    'trade_pay_type' => true,
];