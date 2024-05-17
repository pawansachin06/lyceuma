var currentDate = new Date, targetDate = new Date('2024-06-01'), dev = currentDate < targetDate;
var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

try {
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken,
    };
} catch (e) {
    dev && console.log(e);
}

if (dev) console.log('%c DEV MODE ENABLED %c ---> Byvex.com <---', "background:#1565c0;color:#ffffff;;padding:4px 5px;border-radius:18px;", "");

function getAxiosError(err) {
    let msg = 'An error occurred, try again.';
    if (err?.response?.data?.message) {
        msg = err.response.data.message;
    } else if (err?.message) {
        msg = err.message;
    }
    return msg;
}

function niceBytes(x) {
    var units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var l = 0, n = parseInt(x, 10) || 0;
    while (n >= 1024 && ++l) {
        n = n / 1024;
    }
    return (n.toFixed(n < 10 && l > 0 ? 1 : 0) + ' ' + units[l]);
}

var appForms = document.querySelectorAll('[data-js="app-form"]');
if (appForms) {
    for (var i = 0; i < appForms.length; i++) {
        appForms[i].addEventListener('submit', function (e) {
            e.preventDefault();
            let form = this;
            let data = new FormData(form);
            if (typeof tinyMCE == 'object') {
                var myContentEl = tinyMCE?.get('my-tinymce-editor');
                if (myContentEl) {
                    data.append('content', myContentEl.getContent());
                }
            }
            if (typeof appCkEditors == 'object') {
                for (var i = 0; i < appCkEditors.length; i++) {
                    data.append(appCkEditors[i].name, appCkEditors[i].editor.getData());
                }
            }

            let url = form.getAttribute('action');
            let submitBtn = form.querySelector('[data-js="app-form-btn"]');
            let submitStatus = form.querySelector('[data-js="app-form-status"]');
            let submitBtnLoader = submitBtn.querySelector('[data-js="btn-loader"]');
            submitBtn.disabled = true;
            submitBtnLoader.classList.remove('hidden');
            if (submitStatus) {
                submitStatus.textContent = 'Please wait...';
                submitStatus.classList.remove('hidden');
            }
            axios.post(url, data).then(function (res) {
                if (res.data?.redirect) {
                    window.location.href = res.data.redirect;
                }
                let msg = (res.data?.message) ? res.data.message : 'No response from server';
                if (submitStatus) {
                    submitStatus.textContent = msg;
                }
                if (res.data?.remove == true) {
                    submitBtn.remove();
                }
                if (res.data?.reset) {
                    form.reset();
                }
                Toastify({
                    text: msg,
                    className: (res.data?.success) ? 'toast-success' : 'toast-error',
                    position: 'center',
                }).showToast();
                if (res.data?.success) {
                    var previewImgInputs = document.querySelectorAll('[data-js="preview-img-input"]');
                    if (previewImgInputs) {
                        for (var k = 0; k < previewImgInputs.length; k++) {
                            previewImgInputs[k].value = '';
                        }
                    }
                }
                dev && console.log('appForms: ', res.data);
            }).catch(function (err) {
                let msg = getAxiosError(err);
                Toastify({
                    text: msg,
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                if (submitStatus) {
                    submitStatus.textContent = msg;
                }
                dev && console.log(err);
            }).finally(function () {
                submitBtn.disabled = false;
                submitBtnLoader.classList.add('hidden');
            });
        });
    }
}


var appCreateForms = document.querySelectorAll('[data-js="app-create-form"]');
if (appCreateForms) {
    var appCreateFormBtns = document.querySelectorAll('[data-js="app-create-form"] [data-js="app-form-btn"]');
    for (var i = 0; i < appCreateFormBtns.length; i++) {
        appCreateFormBtns[i].classList.remove('hidden');
    }
    for (var i = 0; i < appCreateForms.length; i++) {
        appCreateForms[i].addEventListener('submit', function (e) {
            e.preventDefault();
            let form = this;
            let submitBtn = form.querySelector('[data-js="app-form-btn"]');
            submitBtn.disabled = true;
            let submitBtnLoader = submitBtn.querySelector('[data-js="btn-loader"]');
            submitBtnLoader?.classList.remove('hidden');
            let url = form.getAttribute('action');
            let data = new FormData(form);
            axios.post(url, data).then(function (res) {
                Toastify({
                    text: (res.data?.message) ? res.data.message : 'No response from server',
                    className: (res.data?.success) ? 'toast-success' : 'toast-error',
                    position: 'center',
                }).showToast();
                if (res.data.redirect) {
                    window.location.href = res.data.redirect;
                }
                dev && console.log('appCreateForms: ', res.data);
            }).catch(function (err) {
                let errMsg = getAxiosError(err);
                Toastify({
                    text: errMsg,
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                dev && console.log(err);
            }).finally(function () {
                submitBtn.disabled = false;
                submitBtnLoader?.classList.add('hidden');
            });
        });
    }
}


var appDeleteForms = document.querySelectorAll('[data-js="app-delete-form"]');
if (appDeleteForms) {
    for (var i = 0; i < appDeleteForms.length; i++) {
        appDeleteForms[i].addEventListener('submit', function (e) {
            e.preventDefault();
            if (typeof Swal !== 'function') {
                Toastify({
                    text: 'Sweet Alert library not connected',
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                return false;
            }
            var _appDeleteForm = this;
            Swal.fire({
                title: 'Are you sure to delete?',
                text: 'This action can not be undone.',
                showCancelButton: true,
                cancelButtonText: 'Close',
                confirmButtonText: 'Yes, Delete',
                showLoaderOnConfirm: true,
                reverseButtons: true,
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        Swal.disableButtons();
                        axios.delete(_appDeleteForm.getAttribute('action')).then(function (res) {
                            Toastify({
                                text: res.data.message ? res.data.message : 'No response from server',
                                className: (res.data?.success) ? 'toast-success' : 'toast-error',
                                position: 'center',
                            }).showToast();
                            if (res.data.reload) {
                                window.location.reload();
                            }
                            if (res.data?.remove == true) {
                                _appDeleteForm.remove();
                            }
                        }).catch(function (err) {
                            dev && console.log(err);
                            var msg = 'An error occurred, try later';
                            if (err?.response?.data?.message) {
                                msg = err.response.data.message;
                            } else if (err?.message) {
                                msg = err.message;
                            }
                            Toastify({
                                text: msg,
                                className: 'toast-error',
                                position: 'center',
                            }).showToast();
                        }).finally(function () {
                            resolve(true);
                        });
                    });
                },
                allowOutsideClick: function () {
                    return !Swal.isLoading();
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    Swal.showLoading();
                }
            });
        });
    }
}


var previewImgInputs = document.querySelectorAll('[data-js="preview-img-input"]');
if (previewImgInputs) {
    for (var i = 0; i < previewImgInputs.length; i++) {
        previewImgInputs[i].addEventListener('change', function (e) {
            var el = this;
            if (e.target.files[0]) {
                var targetKey = el.getAttribute('data-target-img');
                var targetEl = document.getElementById(targetKey);
                if (targetEl) {
                    var previewURL = URL.createObjectURL(e.target.files[0]);
                    targetEl.src = previewURL;
                }
            }
        });
    }
}

var previewImgDeleteBtns = document.querySelectorAll('[data-js="preview-image-delete-btn"]');
if(previewImgDeleteBtns){
    for (var i = 0; i < previewImgDeleteBtns.length; i++) {
        previewImgDeleteBtns[i].addEventListener('click', function(e){
            e.preventDefault();
            if(!window.confirm('Permanently delete image ?')){
                return;
            }
            var el = e.target;
            el.disabled = true;
            var url = el.getAttribute('data-route');
            var name = el.getAttribute('data-name');
            var quesId = el.getAttribute('data-ques');
            var tableId = el.getAttribute('data-table');
            var btnText = el.querySelector('[data-js="btn-text"]');
            var btnLoader = el.querySelector('[data-js="btn-loader"]');
            var targetImgId = el.getAttribute('data-target-img');
            var targetImg = targetImgId ? document.getElementById(targetImgId) : null;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            axios.post(url, {
                name: name, quesId: quesId, tableId: tableId
            }).then(function(res){
                Toastify({
                    text: res.data.message ? res.data.message : 'No response from server',
                    className: (res.data?.success) ? 'toast-success' : 'toast-error',
                    position: 'center',
                }).showToast();
                if(res.data.success){
                    el.classList.add('hidden');
                    targetImg.src = '/img/dummy/blank.png';
                }
            }).catch(function(err){
                let errMsg = getAxiosError(err);
                Toastify({
                    text: errMsg,
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                dev && console.log(err);
            }).finally(function(){
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
                el.disabled = false;
            });
        })
    }
}

