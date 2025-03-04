<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://js.stripe.com/v2/"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

<div class="max-w-7xl mx-auto py-10 px-6 grid grid-cols-1 lg:grid-cols-2 gap-8">

    <!-- Payment Form -->
    <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Payment Details</h2>

        @if (Session::has('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ Session::get('success') }}
            </div>
        @endif

        <form action="{{ url('/command/pay?name='. Auth::user()->name) }}" method="post" class="require-validation space-y-5" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            <div>
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                <input type="text" name="billing_name" class="w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="John Doe">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Card Number</label>
                <input type="text" class="card-number w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="4242 4242 4242 4242">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">CVC</label>
                    <input type="text" class="card-cvc w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="CVC">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Month</label>
                    <input type="text" class="card-expiry-month w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="MM">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Year</label>
                    <input type="text" class="card-expiry-year w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="YYYY">
                </div>
            </div>

            <div class="error hidden p-3 bg-red-100 text-red-700 rounded">
                <p>Please correct the errors and try again.</p>
            </div>

            <input type="hidden" name="balance" value="{{ $totalAmount }}">

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg font-semibold">
                Pay Now
            </button>
        </form>
    </div>


    <!-- Pricing Details -->
    <div class="mt-6 grow sm:mt-8 lg:mt-0">
        <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
            <div class="space-y-2">
                <dl class="flex items-center justify-between">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                    <dd class="text-base font-medium text-green-500">${{ number_format($totalAmount, 2, ',', ' ') }}</dd>
                </dl>
                <dl class="flex items-center justify-between">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Shipping</dt>
                    <dd class="text-base font-medium text-blue-500">{{ $shipping }}</dd>
                </dl>
{{--                <dl class="flex items-center justify-between">--}}
{{--                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Store Pickup</dt>--}}
{{--                    <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>--}}
{{--                </dl>--}}
                <dl class="flex items-center justify-between">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">${{ number_format($Tax, 2, ',', ' ') }}</dd>
                </dl>
            </div>

            <dl class="flex items-center justify-between border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white">${{ number_format($finalAmount, 2, ',', ' ') }}</dd>
            </dl>
        </div>

        <div class="mt-6 flex items-center justify-center gap-8">
            <img class="h-8 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal.svg" alt="Paypal">
            <img class="hidden h-8 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal-dark.svg" alt="Paypal">
            <img class="h-8 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg" alt="Visa">
            <img class="hidden h-8 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg" alt="Visa">
            <img class="h-8 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard.svg" alt="Mastercard">
            <img class="hidden h-8 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard-dark.svg" alt="Mastercard">
        </div>
    </div>

</div>

<script>
    $(function() {
        var $form = $(".require-validation");

        $form.on('submit', function(e) {
            var $inputs = $form.find('.required input');
            var $error = $('.error');
            var valid = true;
            $error.addClass('hidden');

            $inputs.each(function() {
                if (!$(this).val()) {
                    valid = false;
                    $(this).addClass('border-red-500');
                }
            });

            if (!valid) {
                e.preventDefault();
                $error.removeClass('hidden');
                return;
            }

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, function(status, response) {
                    if (response.error) {
                        $error.text(response.error.message).removeClass('hidden');
                    } else {
                        $form.append(`<input type='hidden' name='stripeToken' value='${response.id}'>`);
                        $form.get(0).submit();
                    }
                });
            }
        });
    });
</script>

</body>
</html>
