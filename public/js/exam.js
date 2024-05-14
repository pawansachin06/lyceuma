(function(){
    var examSubjectDifficultyInputs = document.querySelectorAll('[data-js="exam-subject-difficulty-input"]');
    if(examSubjectDifficultyInputs){
        for (var i = 0; i < examSubjectDifficultyInputs.length; i++) {
            examSubjectDifficultyInputs[i].addEventListener('change', function(e){
                var targetElId = e.target.getAttribute('data-difficulty-box-id');
                var targetEl = document.getElementById(targetElId);
                if(targetEl){
                    if(e.target.checked){
                        targetEl.classList.remove('hidden');
                    } else {
                        targetEl.classList.add('hidden');
                    }
                }
            });
        }
    }

})();