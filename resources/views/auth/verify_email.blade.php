@extends('template')
@section('main')
<div class="container mb-4 margin-top-85 min-height">
    <div class="d-flex justify-content-center">
        <div class="p-5 mt-5 mb-5 border w-450">
            <h3 class="text-center mb-4">{{ __('Verify Your Email') }}</h3>
            
            <!-- Display flash messages -->
            @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('alert-class', 'info') }} alert-dismissible fade show mb-4" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            @endif
            
            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <p class="text-center text-16 mb-4">
                {{ __('We have sent a verification code to') }} <strong>{{ $email }}</strong>
            </p>
            <p class="text-center text-14 text-muted mb-4">
                {{ __('Please enter the 6-digit code from your email to complete your registration.') }}
            </p>

            <form method="post" action="{{ url('verify-email-code') }}" class="verify-email-form">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="verification_code" class="text-16">{{ __('Verification Code') }} <span class="text-13 text-danger">*</span></label>
                    @if ($errors->has('verification_code'))
                        <p class="error-tag">{{ $errors->first('verification_code') }}</p>
                    @endif
                    <input type="text" 
                           class="form-control text-16 text-center p-3" 
                           name="verification_code" 
                           id="verification_code" 
                           placeholder="000000" 
                           maxlength="6" 
                           pattern="[0-9]{6}"
                           style="font-size: 24px; letter-spacing: 8px; font-weight: bold;"
                           autocomplete="off"
                           required>
                    <small class="form-text text-muted text-14 mt-2">
                        {{ __('Enter the 6-digit code sent to your email') }}
                    </small>
                </div>

                <button type="submit" class="btn pb-3 pt-3 text-15 button-reactangular vbtn-success w-100 ml-0 mr-0 mb-3">
                    {{ __('Verify Email') }}
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="text-14 mb-2">{{ __('Did not receive the code?') }}</p>
                <a href="{{ url('signup') }}" class="text-14 font-weight-600">
                    {{ __('Sign up again') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var codeInput = document.getElementById('verification_code');
    
    // Only allow numbers
    codeInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Auto-submit when 6 digits are entered
    codeInput.addEventListener('input', function(e) {
        if (this.value.length === 6) {
            // Optional: auto-submit
            // document.querySelector('.verify-email-form').submit();
        }
    });
    
    // Focus on input
    codeInput.focus();
});
</script>
@endsection

