(function () {
    var authCardLoginOtpFormBtn = document.getElementById('auth-card-login-otp-form-btn');
    var authCardLoginOtpForm = document.getElementById('auth-card-login-otp-form');
    var authCardLoginOtpFormStatus = document.getElementById('auth-card-login-otp-form-status');
    var authCardLoginOtpFormStep1 = document.getElementById('auth-card-login-otp-form-step-1');
    var authCardLoginOtpFormStep2 = document.getElementById('auth-card-login-otp-form-step-2');
    if (authCardLoginOtpFormBtn) {
        window.loginRecaptchaVerifier = new firebase.auth.RecaptchaVerifier('auth-login-recaptcha-container', {
            'size': 'normal',
            'callback': function (response) {
                authCardLoginOtpFormBtn.disabled = false;
                authCardLoginOtpFormBtn.classList.remove('hidden');
            },
            'expired-callback': function () {
                authCardLoginOtpFormBtn.disabled = true;
                authCardLoginOtpFormBtn.classList.add('hidden');
            }
        });
        loginRecaptchaVerifier.render();

        function authCardLoginOtpFormSubmit() {
            var phoneNumber = authCardLoginOtpForm.elements.phone.value;
            var otp = authCardLoginOtpForm.elements.otp.value;
            var phoneLoginUrl = authCardLoginOtpForm.getAttribute('action');
            if (window.confirmationResult && window?.userToken?.trim().length > 0) {
                window.confirmationResult.confirm(otp).then(function (result) {
                    dev && console.log(result, result.user);
                    console.log(window.userToken, phoneNumber, phoneLoginUrl);
                }).catch(function (error) {
                    authCardLoginOtpFormStatus.textContent = (error?.message) ? error.message : 'Something went wrong, try again later.';
                    return;
                });
            }

            authCardLoginOtpFormStatus.classList.remove('hidden');
            if (phoneNumber.trim().length < 1) {
                authCardLoginOtpFormStatus.textContent = 'Phone number is required';
                return;
            }
            if (phoneNumber.trim().length != 10) {
                authCardLoginOtpFormStatus.textContent = 'Valid 10 digit phone number is required';
                return;
            }
            if (window.loginRecaptchaVerifier.verify()) {
            } else {
                authCardLoginOtpFormStatus.textContent = 'Please complete reCaptcha';
                return;
            }

            var userPhoneUrl = authCardLoginOtpFormBtn.getAttribute('data-route');
            axios.post(userPhoneUrl, {
                phone: phoneNumber
            }).then(function (res) {
                if (res.data.success && res.data.token) {
                    window.userToken = res.data.token;
                    phoneNumber = '+91' + phoneNumber;
                    authCardLoginOtpFormStatus.textContent = 'Sending OTP, please wait...';
                    console.log(phoneNumber, window.loginRecaptchaVerifier.verify());
                    firebase.auth().signInWithPhoneNumber(phoneNumber, window.loginRecaptchaVerifier).then(function (confirmationResult) {
                        window.confirmationResult = confirmationResult;
                        dev && console.log(window.confirmationResult);
                        authCardLoginOtpFormStatus.textContent = 'OTP sent successfully';
                        authCardLoginOtpFormStep1.classList.add('hidden');
                        authCardLoginOtpFormStep2.classList.remove('hidden');
                        authCardLoginOtpFormBtn.querySelector('[data-js="btn-text"]').textContent = 'Verify OTP';
                    }).catch(function (error) {
                        dev && console.log(error);
                        window.userToken = null;
                        authCardLoginOtpFormStatus.textContent = (error?.message) ? error.message : 'Something went wrong, use login with Google';
                    });
                } else {
                    authCardLoginOtpFormStatus.textContent = (res.data?.message) ? res.data.message : 'No response from server';
                    return;
                }
            }).catch(function (err) {
                let errMsg = getAxiosError(err);
                authCardLoginOtpFormStatus.textContent = errMsg;
                return;
            });
        }

        authCardLoginOtpForm.addEventListener('submit', function (e) {
            e.preventDefault();
            authCardLoginOtpFormSubmit();
        })

    }
    // function render() {
    //     window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    //     recaptchaVerifier.render();
    // }
    // render();

    // var authPhoneSendOtpBtn = document.getElementById('auth-phone-send-otp-btn');
    // var authPhoneNumber = document.getElementById('auth-phone-number');
    // if (authPhoneSendOtpBtn) {
    //     authPhoneSendOtpBtn.addEventListener('click', function (e) {
    //         e.preventDefault();
    //         var number = '+91' + authPhoneNumber.value;
    //         dev && console.log(window.recaptchaVerifier);
    //         firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
    //             //s is in lowercase
    //             window.confirmationResult = confirmationResult;
    //             coderesult = confirmationResult;
    //             console.log(coderesult);
    //             alert("Message sent");
    //         }).catch(function (error) {
    //             alert(error.message);
    //         });

    //     });
    // }

    function codeverify() {
        var code = document.getElementById('verificationCode').value;
        coderesult.confirm(code).then(function (result) {
            var user = result.user;
            console.log(user);
            alert('done');
            window.location.replace('complete_registration.php');
        }).catch(function (error) {
            alert(error.message);
        });
    }




})();
