<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $address = Address::where('user_id', Auth::id())->first();

        if ($address) {
            $address->country = $request['country'];
            $address->address = $request['address'];
            $address->state = $request['state'];
            $address->city = $request['city'];
            $address->postal_code = $request['postal_code'];

            $address->save();
        } else {
            Address::create([
                'country' => $request['country'],
                'address' => $request['address'],
                'state' => $request['state'],
                'city' => $request['city'],
                'postal_code' => $request['postal_code'],
                'user_id' => Auth::id()
            ]);
        }

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

        try {
            Stripe\Charge::create ([
                "amount" => $request['balance'] * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => ""
            ]);

            echo "<script>localStorage.clear();</script>";
            return  view('client.success');
        } catch (Stripe\Exception\CardException $e) {
            echo $e->getMessage();
        }

    }
}
