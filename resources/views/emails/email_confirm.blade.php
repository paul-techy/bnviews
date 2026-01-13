@extends('emails.template')

@section('emails.main')

<div class="mt-20 text-left">
  <p>Hi {{ $first_name }},</p>
  <p>
    @if($type == 'register')
        Welcome to {{ siteName() }}! Please verify your email address using the verification code below to activate your account and start using our services.
    @elseif($type == 'change')
        Please click the link below to complete the process of changing your email address.
    @else
        Please Confirm your email address:
    @endif
  </p>

  @if($type == 'register' && isset($verification_code))
    <div class="mt-20 text-center" style="background-color: #f5f5f5; padding: 20px; border-radius: 5px; margin: 20px 0;">
      <p style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">{{ __('Your Verification Code') }}</p>
      <p style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #1dbf73; margin: 0;">{{ $verification_code }}</p>
      <p style="font-size: 12px; color: #666; margin-top: 10px;">{{ __('Enter this code on the verification page to complete your registration.') }}</p>
    </div>
  @endif

  <p class="mt-20 text-center">
    <a href="{{ $url . ('users/confirm_email?code=' . $token) }}" target="_blank">
      <button type="button" class="learn-more">{{ __('Confirm Email') }}</button>
    </a>
  </p>
</div>


@stop



