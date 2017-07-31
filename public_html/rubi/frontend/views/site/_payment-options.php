<?php
    use Yii;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\BaseHtml;
    use yii\widgets\ActiveForm;  
?>

<div class="row">
    <div id="paypal" class="col-md-6" aria-live="assertive" style="">
    
    </div>
    <a id="cc" class="col-md-6 btn btn-secondary btn-green" href="" title="Click here to pay by Credit Card">
        Pay By Credit Card
    </a>
</div>

<div id="cc-info" aria-hidden="true">

    <!--<form id="checkout-form" action="/transaction-endpoint" method="post">-->
    <?php $form = ActiveForm::begin([
        'id' => 'checkout-form',
        'action' => ['site/transaction-endpoint'],
    ]); ?>
        <div id="error-message"></div>

        <label for="card-number">Card Number</label>
        <div class="hosted-field" id="card-number"></div>

        <label for="cvv">CVV</label>
        <div class="hosted-field" id="cvv"></div>

        <label for="expiration-date">Expiration Date</label>
        <div class="hosted-field" id="expiration-date"></div>

        <!--<label for="postal-code">Postal</label>
        <div class="hosted-field" id="postal-code"></div>-->

        <input name="payment_method_nonce" readonly type="hidden">
        <input type="submit" value="Pay">
    <!--</form>-->
    <?php ActiveForm::end(); ?>

    <!-- Load the Client component. -->
    <script src="https://js.braintreegateway.com/web/3.11.1/js/client.min.js"></script>

    <!-- Load the Hosted Fields component. -->
    <script src="https://js.braintreegateway.com/web/3.11.1/js/hosted-fields.min.js"></script>

    <script>
        // get client token from server 
        <?php Yii::$app->view->registerJs('var token = "'. $clientToken.'"',  \yii\web\View::POS_HEAD); ?>
        // console.log(token);

        // generated client token
        var authorization = token;

        // form 
        var form = document.querySelector('#checkout-form');      

        var submit = document.querySelector('input[type="submit"]');

        braintree.client.create({
            authorization: authorization
        }, function (clientErr, clientInstance) {
            if (clientErr) {
                // Handle error in client creation
                console.error(clientErr);
                return;
            }

            braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '14pt'
                    },
                    'input.invalid': {
                        'color': 'red'
                    },
                    'input.valid': {
                        'color': 'green'
                    }
                },
                fields: {
                    number: {
                        selector: '#card-number',
                        placeholder: '4111 1111 1111 1111'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: '123'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        placeholder: '10/2019'
                    }
                }
            }, function (hostedFieldsErr, hostedFieldsInstance) {
                if (hostedFieldsErr) {
                    // Handle error in Hosted Fields creation
                    console.error(hostedFieldsErr);
                    return;
                }

                submit.removeAttribute('disabled');

                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    hostedFieldsInstance.tokenize(function (tokenizeErr, playload) {
                        if (tokenizeErr) {
                            // Handle error in Hoster Fields tokenization
                            console.error(tokenizeErr);
                            return;
                        }

                        // Put 'payload.nonce' into the 'payment_method_nonce' input, and then
                        // submit the form. 
                        document.querySelector('input[name="payment_method_nonce"]').value = payload.nonce;
                        form.submit();
                    });
                }, false);
            });
        });
    </script>

</div>