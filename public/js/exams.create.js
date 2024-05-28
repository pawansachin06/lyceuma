(function () {
    var examCreateForm = document.getElementById('exam-create-form');
    var examCreateSubmitBtn = document.getElementById('exam-create-submit-btn');
    var classroomsCheckboxes = document.querySelectorAll('[data-js="exam-create-classrooms-checkbox"]')
    var subjectsCheckboxes = document.querySelectorAll('[data-js="exam-create-subjects-checkbox"]');
    var difficultiesBox = document.getElementById('difficulties-box');
    if (examCreateForm && examCreateSubmitBtn) {
        examCreateSubmitBtn.classList.remove('hidden');
        examCreateForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var atLeastOneClassroomPicked = false;
            classroomsCheckboxes.forEach(function (cc) {
                if (cc.checked) {
                    atLeastOneClassroomPicked = true;
                }
            });
            if (!atLeastOneClassroomPicked) {
                Toastify({
                    text: 'Please pick one classroom',
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                return;
            }

            var atLeastOneSubjectPicked = false;
            subjectsCheckboxes.forEach(function (sc) {
                if (sc.checked) {
                    atLeastOneSubjectPicked = true;
                }
            });
            if (!atLeastOneSubjectPicked) {
                Toastify({
                    text: 'Please pick one subject',
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                return;
            }

            examCreateSubmitBtn.disabled = true;
            var submitLoader = examCreateSubmitBtn.querySelector('[data-js="btn-loader"]');
            if(submitLoader) submitLoader.classList.remove('hidden');
            var formData = new FormData(examCreateForm);
            axios.post(
                examCreateForm.getAttribute('action'), formData
            ).then(function (res) {
                if (res.data?.redirect) {
                    window.location.href = res.data.redirect;
                }
                msg = (res.data?.message) ? res.data.message : 'No response from server';
                Toastify({
                    text: msg,
                    className: (res.data?.success) ? 'toast-success' : 'toast-error',
                    position: 'center',
                }).showToast();
            }).catch(function(err){
                let msg = getAxiosError(err);
                Toastify({
                    text: msg,
                    className: 'toast-error',
                    position: 'center',
                }).showToast();
                dev && console.log(err);
            }).finally(function(){
                if(submitLoader) submitLoader.classList.add('hidden');
                examCreateSubmitBtn.disabled = false;
            });
        });

        if (subjectsCheckboxes) {

            for (var i = 0; i < subjectsCheckboxes.length; i++) {
                subjectsCheckboxes[i].addEventListener('change', function (e) {
                    var subjectsCheckbox = e.target;
                    var targetDifficultyBoxId = 'sub-diff-' + subjectsCheckbox.value;
                    var targetDifficultyBox = document.getElementById(targetDifficultyBoxId);
                    var targetDifficultySelectId = 'sub-diff-select-' + subjectsCheckbox.value;
                    var targetDifficultySelect = document.getElementById(targetDifficultySelectId);
                    if (subjectsCheckbox.checked) {
                        targetDifficultySelect.required = true;
                        targetDifficultyBox.classList.remove('hidden');
                    } else {
                        targetDifficultySelect.required = false;
                        targetDifficultyBox.classList.add('hidden');
                    }

                    var atLeastOneSubjectPicked = false;
                    subjectsCheckboxes.forEach(function (sc) {
                        if (sc.checked) {
                            atLeastOneSubjectPicked = true;
                        }
                    });
                    if (atLeastOneSubjectPicked) {
                        difficultiesBox.classList.remove('hidden');
                    } else {
                        difficultiesBox.classList.add('hidden');
                    }

                });
            }
        }
    }
})();