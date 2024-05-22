(function () {

    var authLoginOtpSendBtn = document.querySelector('[data-js="auth-login-otp-send-btn"]');
    var authLoginOtpVerifyBtn = document.querySelector('[data-js="auth-login-otp-verify-btn"]');
    var authLoginOtpPhone = document.querySelector('[data-js="auth-login-otp-phone"]');
    var authLoginOtpCode = document.querySelector('[data-js="auth-login-otp-code"]');
    var authLoginOtpStatus = document.querySelector('[data-js="auth-login-otp-status"]');
    var authLoginOtpStep1 = document.querySelector('[data-js="auth-login-otp-step-1"]');
    var authLoginOtpStep2 = document.querySelector('[data-js="auth-login-otp-step-2"]');
    var phoneNumber = '';
    var userToken = '';

    function sendLoginOtp() {
        phoneNumber = authLoginOtpPhone.value;
        authLoginOtpStatus.classList.remove('hidden');

        if (phoneNumber.trim().length < 1) {
            authLoginOtpStatus.textContent = 'Phone number is required';
            return;
        }
        if (phoneNumber.trim().length != 10) {
            authLoginOtpStatus.textContent = 'Valid 10 digit phone number is required';
            return;
        }
        if (!window.loginRecaptchaVerifier.verify()) {
            authLoginOtpStatus.textContent = 'Please complete reCaptcha';
            return;
        }
        var url = authLoginOtpSendBtn.getAttribute('data-route');
        authLoginOtpSendBtn.classList.add('hidden');
        axios.post(url, {
            phone: phoneNumber
        }).then(function (res) {
            if (res.data.success && res.data.token) {
                userToken = res.data.token;
                phoneNumber = '+91' + phoneNumber;
                authLoginOtpStatus.textContent = 'Sending OTP, please wait...';
                console.log(phoneNumber, window.loginRecaptchaVerifier.verify());
                firebase.auth().signInWithPhoneNumber(phoneNumber, window.loginRecaptchaVerifier).then(function (confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    dev && console.log(window.confirmationResult);
                    authLoginOtpStatus.textContent = 'OTP sent successfully';
                    authLoginOtpStep1.classList.add('hidden');
                    authLoginOtpStep2.classList.remove('hidden');
                    authLoginOtpSendBtn.classList.add('hidden');
                    authLoginOtpVerifyBtn.classList.remove('hidden');
                }).catch(function (error) {
                    dev && console.log(error);
                    window.userToken = null;
                    authLoginOtpSendBtn.classList.remove('hidden');
                    authLoginOtpStatus.textContent = (error?.message) ? error.message : 'Something went wrong, use login with Google';
                });
            } else {
                authLoginOtpSendBtn.classList.remove('hidden');
                authLoginOtpStatus.textContent = (res.data?.message) ? res.data.message : 'No response from server';
                return;
            }
        }).catch(function (err) {
            let errMsg = getAxiosError(err);
            authLoginOtpStatus.textContent = errMsg;
            authLoginOtpSendBtn.classList.remove('hidden');
            return;
        });
    }

    function verifyLoginOtp() {
        var otpCode = authLoginOtpCode.value;
        if (otpCode.trim().length < 1) {
            authLoginOtpStatus.textContent = 'OTP is required';
            return;
        }
        if (otpCode.trim().length != 6) {
            authLoginOtpStatus.textContent = 'Valid 6 digit otp is required';
            return;
        }
        authLoginOtpVerifyBtn.classList.add('hidden');
        var url = authLoginOtpVerifyBtn.getAttribute('data-route');
        window.confirmationResult.confirm(otpCode).then(function (result) {
            console.log(result);
            authLoginOtpStatus.textContent = 'Logging in...';
            axios.post(url, {
                deviceToken: userToken,
                phone: phoneNumber,
            }).then(function (res) {
                if (res.data.redirect) {
                    window.location.href = res.data.redirect;
                }
                if(res.data.success){
                    //
                } else {
                    authLoginOtpVerifyBtn.classList.remove('hidden');
                }
                authLoginOtpStatus.textContent = (res.data?.message) ? res.data.message : 'No response from server';
            }).catch(function (err) {
                let errMsg = getAxiosError(err);
                authLoginOtpStatus.textContent = errMsg;
                authLoginOtpVerifyBtn.classList.remove('hidden');
                return;
            });
        }).catch(function (error) {
            authLoginOtpVerifyBtn.classList.remove('hidden');
            if (error?.code && error.code == 'auth/invalid-verification-code') {
                authLoginOtpStatus.textContent = 'Code invalid, try again';
            } else {
                authLoginOtpStatus.textContent = (error?.message) ? error.message : 'Something went wrong!';
            }
        });
    }

    if (authLoginOtpSendBtn) {
        window.loginRecaptchaVerifier = new firebase.auth.RecaptchaVerifier('auth-login-recaptcha-container', {
            'size': 'normal',
            'callback': function (response) {
                authLoginOtpSendBtn.disabled = false;
                authLoginOtpSendBtn.classList.remove('hidden');
            },
            'expired-callback': function () {
                authLoginOtpSendBtn.disabled = true;
                authLoginOtpSendBtn.classList.add('hidden');
            }
        });
        loginRecaptchaVerifier.render();

        authLoginOtpSendBtn.addEventListener('click', sendLoginOtp);
    }

    if (authLoginOtpVerifyBtn) {
        authLoginOtpVerifyBtn.addEventListener('click', verifyLoginOtp);
    }


})();
