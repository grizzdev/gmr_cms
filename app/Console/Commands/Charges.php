<?php

namespace App\Console\Commands;

use GuzzleHttp\Client as Client;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Charges extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'charges';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Process next un-charged order';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		echo "\n".date('Y-m-d h:i:s')." Processing Charges\n";
		$order = Order::whereNotIn('status_id', [3,4,5])->where('payment_status_id', '=', 1)->first();
		echo "\tOrder: {$order->id}\n";
		echo "\tTotal: $".$order->cart->total()."\n";

		if ($order->payment_method_id == 1) { // Stripe
			echo "\tProcessing via Stripe\n";
			Stripe::setApiKey(config('services.stripe.secret'));
			$has_donation = false;
			$only_donation = true;

			$charge_data = [
					'source' => $order->payment_token,
					'amount' => ($order->cart->total() * 100),
					'currency' => 'usd',
					'description' => 'Gamerosity Order #'.$order->id
			];

			foreach ($order->cart->items as $item) {
					if ($item->product->id == 1) {
							$has_donation = true;
					} else {
							$only_donation = false;
					}
			}

			try {
					$charge = Charge::create($charge_data);
					$data = json_decode(preg_replace('/Stripe.*: {/', '{', $charge));

					$order->payment_id = $data->id;
					$order->payment_status_id = 7;

					if ($has_donation && $only_donation) {
						$order->status_id = 3;
					} elseif ($order->status_id == 1) {
						$order->status_id = 2;
					}

					$order->save();

					echo "\tCharge successful: {$data->id}\n";
			} catch(\Stripe\Error\Card $e) {
					$body = $e->getJsonBody();
					$err = $body['error'];

					$order->payment_status_id = 8;
					$order->status_id = 4;
					$order->notes = $order->notes."\n\n".date('Y-m-d g:i')." Charge Result: {$err['message']}";
					$order->save();

					echo "\tCharge Result: {$err['message']}\n";
			} catch (\Stripe\Error\InvalidRequest $e) {
					$body = $e->getJsonBody();
					$err = $body['error'];

					$order->notes = $order->notes."\n\n".date('Y-m-d g:i')." Charge Result: {$err['message']}";
					$order->save();

					echo "\tCharge Result: {$err['message']}\n";
			} catch (\Stripe\Error\Authentication $e) {
					// Authentication with Stripe's API failed
					// (maybe you changed API keys recently)
			} catch (\Stripe\Error\ApiConnection $e) {
					// Network communication with Stripe failed
			} catch (\Stripe\Error\Base $e) {
					// Display a very generic error to the user, and maybe send
					// yourself an email
			} catch (Exception $e) {
					// Something else happened, completely unrelated to Stripe
			}
		} elseif ($order->payment_method_id == 2) { // PayPal
			echo "\tProcessing via PayPal\n";

			$response = (new Client())->get(config('services.paypal.url'), [
				'verify' => false,
				'query' => [
					'USER' => config('services.paypal.user'),
					'PWD' => config('services.paypal.pwd'),
					'SIGNATURE' => config('services.paypal.signature'),
					'METHOD' => 'DoExpressCheckoutPayment',
					'VERSION' => 93,
					'TOKEN' => $order->payment_token,
					'PAYERID' => $order->payer_id,
					'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
					'PAYMENTREQUEST_0_AMT' => $order->total(),
					'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
				]
			]);

			print_r($response);
			print_r($response->getStatusCode());
			print_r($response->getBody());
		}
	}
}