(function(){
    var authCardLoginForm = document.getElementById('auth-card-login-form');
    authCardLoginForm?.addEventListener('submit', function(e){
        e.preventDefault();
        var submitBtn = authCardLoginForm.querySelector('[data-js="submit-btn"]');
        submitBtn.disabled = true;
        var submitLoader = submitBtn.querySelector('[data-js="btn-loader"]');
        submitLoader.classList.remove('hidden');
        var submitStatus = authCardLoginForm.querySelector('[data-js="submit-status"]');
        submitLoader.classList.remove('hidden');
        submitStatus.textContent = 'Connecting, please wait...';
        submitStatus.classList.add('bg-gray-100');
        submitStatus.classList.remove('hidden', 'bg-green-50', 'text-green-500', 'border-green-600', 'bg-red-100', 'text-red-800', 'border-red-600');
        var url = authCardLoginForm.getAttribute('action');
        var formData = new FormData(authCardLoginForm);
        axios.post(url, formData).then(function(res){
            submitStatus.classList.remove('bg-gray-100');
            if(res.data.success || res.status == 200){
                authCardLoginForm.reset();
                window.location.reload();
                submitStatus.textContent = (res.data?.message) ? res.data.message : 'Refreshing...';
                submitStatus.classList.add('bg-green-50', 'text-green-500', 'border-green-600');
            } else {
                submitStatus.classList.add('bg-red-100', 'text-red-800', 'border-red-600');
                submitStatus.textContent = (res.data?.message) ? res.data.message : 'No response from server';
            }
        }).catch(function(err){
            let errMsg = getAxiosError(err);
            submitStatus.textContent = errMsg;
            submitStatus.classList.remove('bg-gray-100');
            submitStatus.classList.add('bg-red-100', 'text-red-800', 'border-red-600');
            if(err.response.status == 403){
                if( err.request.responseURL ){
                    window.location.href = err.request.responseURL;
                }
            }
        }).finally(function(){
            submitBtn.disabled = false;
            submitLoader.classList.add('hidden');
        });
    });

    var authCardRegisterForm = document.getElementById('auth-card-register-form');
    authCardRegisterForm?.addEventListener('submit', function(e){
        e.preventDefault();
        var submitBtn = authCardRegisterForm.querySelector('[data-js="submit-btn"]');
        submitBtn.disabled = true;
        var submitLoader = submitBtn.querySelector('[data-js="btn-loader"]');
        submitLoader.classList.remove('hidden');
        var submitStatus = authCardRegisterForm.querySelector('[data-js="submit-status"]');
        submitLoader.classList.remove('hidden');
        submitStatus.textContent = 'Connecting, please wait...';
        submitStatus.classList.add('bg-gray-100');
        submitStatus.classList.remove('hidden', 'bg-green-50', 'text-green-500', 'border-green-600', 'bg-red-100', 'text-red-800', 'border-red-600');
        var url = authCardRegisterForm.getAttribute('action');
        var formData = new FormData(authCardRegisterForm);
        formData.append('password_confirmation', authCardRegisterForm.elements.password.value);
        axios.post(url, formData).then(function(res){
            submitStatus.classList.remove('bg-gray-100');
            if(res.data.success || res.status == 200){
                authCardRegisterForm.reset();
                window.location.reload();
                submitStatus.textContent = (res.data?.message) ? res.data.message : 'Refreshing...';
                submitStatus.classList.add('bg-green-50', 'text-green-500', 'border-green-600');
            } else {
                submitStatus.classList.add('bg-red-100', 'text-red-800', 'border-red-600');
                submitStatus.textContent = (res.data?.message) ? res.data.message : 'No response from server';
            }
        }).catch(function(err){
            let errMsg = getAxiosError(err);
            let nextErrorIndex = errMsg.indexOf('(');
            if (nextErrorIndex !== -1) {
                errMsg = errMsg.substring(0, nextErrorIndex).trim();
            }
            submitStatus.textContent = errMsg;
            submitStatus.classList.remove('bg-gray-100');
            submitStatus.classList.add('bg-red-100', 'text-red-800', 'border-red-600');
            if(err.response.status == 403){
                if( err.request.responseURL ){
                    window.location.href = err.request.responseURL;
                }
            }
            dev && console.log(err);
        }).finally(function(){
            submitBtn.disabled = false;
            submitLoader.classList.add('hidden');
        });
    });

    if(typeof tippy !== 'undefined'){
        tippy('[data-tippy-content]');
    }


    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(function (reg) {
                console.log('Service worker registered.');
            })
            .catch(function (err) {
                console.log('Service worker registration failed:', err);
            });
    }

    var deferredPrompt;
    var liteAppBtns = document.querySelectorAll('.lite-app-btn')
    if (liteAppBtns) {
        window.addEventListener('beforeinstallprompt', function (e) {
            e.preventDefault();
            deferredPrompt = e;
            for (var i = 0; i < liteAppBtns.length; i++) {
                liteAppBtns[i].classList.remove('hidden');
                liteAppBtns[i].addEventListener('click', function (e) {
                    var liteAppBtn = e.target;
                    liteAppBtn.classList.add('hidden');
                    deferredPrompt.prompt()
                    deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            console.log('User accepted the A2HS prompt');
                        } else {
                            console.log('User dismissed the A2HS prompt');
                        }
                        deferredPrompt = null;
                    });
                });
            }
        });
    }
})();