(function(){
    var examSubjectsRadios = document.querySelectorAll('[data-js="question-subjects-radio"]');
    var examChaptersSelect = document.querySelector('[data-js="chapters-select"]');
    var examTopicsSelect   = document.querySelector('[data-js="topics-select"]');
    if(examSubjectsRadios && examChaptersSelect){
        for (var i = 0; i < examSubjectsRadios.length; i++) {
            examSubjectsRadios[i].addEventListener('change', function(e){
                var subjectId = e.target.value;

                examChaptersSelect.disabled = true;
                while (examChaptersSelect.firstChild) {
                    examChaptersSelect.removeChild(examChaptersSelect.firstChild);
                }
                var option = document.createElement('option');
                option.value = '';
                option.textContent = 'Pick chapter';
                examChaptersSelect.appendChild(option);

                if(examTopicsSelect){
                    while (examTopicsSelect.firstChild) {
                        examTopicsSelect.removeChild(examTopicsSelect.firstChild);
                    }
                    var option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Pick topic';
                    examTopicsSelect.appendChild(option);
                }

                axios.post(CHAPTERS_API, {
                    subjectId: subjectId
                }).then(function(res){
                    if(res.data.items){
                        for (var i = 0; i < res.data.items.length; i++) {
                            var option = document.createElement('option');
                            option.value = res.data.items[i]['id'];
                            option.textContent = res.data.items[i]['name'];
                            examChaptersSelect.appendChild(option);
                        }
                    }
                }).catch(function(err){
                    console.log(err);
                    alert((err?.message) ? err.message : 'An error occured in fetching chapters');
                }).finally(function(){
                    examChaptersSelect.disabled = false;
                });
            });
        }
    }

    if(examChaptersSelect && examTopicsSelect){
        examChaptersSelect.addEventListener('change', function(e){
            var chapterId = e.target.value;

            examTopicsSelect.disabled = true;

            while (examTopicsSelect.firstChild) {
                examTopicsSelect.removeChild(examTopicsSelect.firstChild);
            }
            var option = document.createElement('option');
            option.value = '';
            option.textContent = 'Pick topic';
            examTopicsSelect.appendChild(option);

            axios.post(CHAPTERS_API, {
                chapterId: chapterId
            }).then(function(res){
                if(res.data.items){
                    for (var i = 0; i < res.data.items.length; i++) {
                        var option = document.createElement('option');
                        option.value = res.data.items[i]['id'];
                        option.textContent = res.data.items[i]['name'];
                        examTopicsSelect.appendChild(option);
                    }
                }
            }).catch(function(err){
                console.log(err);
                alert((err?.message) ? err.message : 'An error occured in fetching topics');
            }).finally(function(){
                examTopicsSelect.disabled = false;
            });
        });
    }

    var questionsImportForm = document.getElementById('questions-import-form');
    if(questionsImportForm){
        questionsImportForm.classList.remove('hidden');
        var questionsImportFormUrl = questionsImportForm.getAttribute('action');
        questionsImportForm.addEventListener('submit', function(e){
            e.preventDefault();
            var data = new FormData(questionsImportForm);
            var submitBtn = questionsImportForm.querySelector('[data-js="app-form-btn"]');
            submitBtn.disabled = true;
            var submitBtnText = submitBtn.querySelector('[data-js="btn-text"]');
            submitBtnText.textContent = 'Uploading';
            var submitBtnLoader = submitBtn.querySelector('[data-js="btn-loader"]');
            submitBtnLoader.classList.remove('hidden');
            var submitStatus = questionsImportForm.querySelector('[data-js="app-form-status"]');
            submitStatus.classList.remove('hidden');
            submitStatus.textContent = 'Connecting, please wait...';
            axios.post(questionsImportFormUrl, data, {
                onUploadProgress: function (e) {
                    var percent = (e.loaded / e.total) * 100;
                    if(percent > 99){
                        submitStatus.textContent = 'Processing file, please wait...';
                    } else {
                        submitStatus.textContent = 'Uploaded ' + niceBytes(e.loaded) + ' of ' + niceBytes(e.total);
                    }
                }
            }).then(function(res){
                let msg = (res.data?.message) ? res.data.message : 'No response from server';
                if (res.data?.reset) {
                    questionsImportForm.reset();
                }
                Toastify({
                    text: msg,
                    className: (res.data?.success) ? 'toast-success' : 'toast-error',
                    position: 'center',
                }).showToast();
                submitStatus.textContent = msg;
            }).catch(function(err){
                let msg = getAxiosError(err);
                Toastify({
                    text: msg,
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                dev && console.log(err);
            }).finally(function(){
                submitBtn.disabled = false;
                submitBtnText.textContent = 'Upload another file';
                submitBtnLoader.classList.add('hidden');
            });
        });
    }


    var questionsExportForm = document.getElementById('questions-export-form');
    if(questionsExportForm){
        questionsExportForm.classList.remove('hidden');
        var questionsExportFormUrl = questionsExportForm.getAttribute('action');
        questionsExportForm.addEventListener('submit', function(e){
            e.preventDefault();
            var data = new FormData(questionsExportForm);
            var submitBtn = questionsExportForm.querySelector('[data-js="app-form-btn"]');
            submitBtn.disabled = true;
            var submitBtnText = submitBtn.querySelector('[data-js="btn-text"]');
            submitBtnText.textContent = 'Uploading';
            var submitBtnLoader = submitBtn.querySelector('[data-js="btn-loader"]');
            submitBtnLoader.classList.remove('hidden');
            var submitStatus = questionsExportForm.querySelector('[data-js="app-form-status"]');
            submitStatus.classList.remove('hidden');
            submitStatus.textContent = 'Connecting, please wait...';
            axios.post(questionsExportFormUrl, data).then(function(res){
                let msg = (res.data?.message) ? res.data.message : 'No response from server';
                if (res.data?.reset) {
                    questionsExportForm.reset();
                }
                if(res.data.success && res.data.download){
                    var a = document.createElement('a');
                    a.href = res.data.download;
                    a.setAttribute('target', '_blank');
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    submitStatus.textContent = '';
                } else {
                    Toastify({
                        text: msg,
                        className: (res.data?.success) ? 'toast-success' : 'toast-error',
                        position: 'center',
                    }).showToast();
                    submitStatus.textContent = msg;
                }
            }).catch(function(err){
                let msg = getAxiosError(err);
                Toastify({
                    text: msg,
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                dev && console.log(err);
            }).finally(function(){
                submitBtn.disabled = false;
                submitBtnText.textContent = 'Download another file';
                submitBtnLoader.classList.add('hidden');
            });
        });
    }

})();