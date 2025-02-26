<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
  public function showDonationForm()
  {
    return view('pages.donations.form');
  }

  public function processDonation(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'amount' => 'required|numeric|min:1',
    ]);

    $splitName = $this->splitName($request->name);

    // Save donation to database
    $donation = Donation::create([
      'name' => $request->name,
      'email' => $request->email,
      'amount' => $request->amount,
      'currency' => 'MWK',
      'status' => 'pending',
    ]);

    // Initiate PayChangu payment
    $response = Http::withHeaders([
      'Authorization' => 'Bearer ' . config('services.paychangu.api_key'),
      'Content-Type' => 'application/json',
    ])->post(config('services.paychangu.base_url') . '/payments', [
      'amount' => $request->amount,
      'currency' => 'MWK',
      'email' => $request->email,
      'first_name' => $splitName['first'],
      'last_name' => $splitName['second'],
      'reference' => 'DONATION-' . $donation->id,
      'callback_url' => route('donation.callback'),
      'return_url' => route('donation.success', ['donation' => $donation->id]),
      'cancel_url' => route('donation.cancel', ['donation' => $donation->id]),
    ]);

    if ($response->successful()) {
      $paymentData = $response->json();

      $donation->update([
        'paychangu_transaction_id' => $paymentData['transaction_id'],
      ]);

      // Redirect to PayChangu payment page
      return redirect($paymentData['payment_url']);
    } else {
      Log::error('PayChangu Error: ' . $response->body());
      return back()->with('error', 'An error occurred while processing your donation. Please try again.');
    }
  }

  public function donationCallback(Request $request)
  {
    // Validate the incoming request
    $request->validate([
      'transaction_id' => 'required|string',
      'status' => 'required|string|in:success,failed,pending',
    ]);

    $transactionId = $request->input('transaction_id');
    $status = $request->input('status');

    // Update donation status
    $donation = Donation::where('paychangu_transaction_id', $transactionId)->first();

    if ($donation) {
      $donation->update(['status' => $status]);

      // Optionally, send an email notification or trigger other actions
      if ($status === 'success') {
        // Send a thank-you email
      }
    }

    return response()->json(['success' => true]);
  }

  public function donationSuccess(Request $request, Donation $donation)
  {
    return view('pages.donations.success', compact('donation'));
  }

  public function donationCancel(Request $request, Donation $donation)
  {
    return view('pages.donations.cancel', compact('donation'));
  }

  private function splitName($name) {
    $parts = explode(" ", $name);
    $firstPart = $parts[0];
    $secondPart = isset($parts[1]) ? $parts[1] : null;

    return [
      'first' => $firstPart,
      'second' => $secondPart
    ];
  }
}
