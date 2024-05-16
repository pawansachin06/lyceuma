(function(){
    var examSubjectsSelect = document.querySelector('[data-js="exam-subjects-select"]');
    var examChaptersSelect = document.querySelector('[data-js="exam-chapters-select"]');
    if(examSubjectsSelect && examChaptersSelect){
        examSubjectsSelect.addEventListener('change', function(e){
            var subjectId = examSubjectsSelect.value;
            examChaptersSelect.disabled = true;
            while (examChaptersSelect.firstChild) {
                examChaptersSelect.removeChild(examChaptersSelect.firstChild);
            }
            var option = document.createElement('option');
            option.value = '';
            option.textContent = 'Pick topic';
            examChaptersSelect.appendChild(option);
            axios.get(EXAM_CHAPTERS_API + '?subjectId=' + subjectId).then(function(res){
                if(res.data.items){
                    for (var i = 0; i < res.data.items.length; i++) {
                        if(res.data.items[i].topics?.length){
                            var optionGroup = document.createElement('optgroup');
                            optionGroup.label = res.data.items[i]['name'];
                            for (var j = 0; j < res.data.items[i].topics.length; j++) {
                                var option = document.createElement('option');
                                option.value = res.data.items[i].topics[j]['id'];
                                option.textContent = res.data.items[i].topics[j]['name'];
                                optionGroup.appendChild(option);
                            }
                            examChaptersSelect.appendChild(optionGroup);
                        }
                    }
                }
            }).catch(function(err){
                console.log(err);
                alert((err?.message) ? err.message : 'An error occured in fetching topics');
            }).finally(function(){
                examChaptersSelect.disabled = false;
            });
        });
    }
})();