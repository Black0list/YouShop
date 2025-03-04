<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        $totalAmount  = $request['finalAmount'];
        $Tax = 99;
        $shipping = 'Free';
        $finalAmount = $totalAmount + $Tax;
        return view('client.stripe', compact('totalAmount', 'Tax', 'finalAmount', 'shipping'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $request['balance'] * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => ""
        ]);

        return  view('client.success');

    }
}
