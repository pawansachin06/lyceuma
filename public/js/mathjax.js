var ckeditorToMathjaxBtns = document.querySelectorAll('[data-js="ckeditor-to-mathjax-btn"]');

window.MathJax = {
    startup: {
        pageReady: function () {
            var input = document.getElementById('mathjax-input');
            var output = document.getElementById('mathjax-preview');
            // var button = document.getElementById('renderHTML');

            if(ckeditorToMathjaxBtns){
                for (var j = 0; j < ckeditorToMathjaxBtns.length; j++) {
                    ckeditorToMathjaxBtns[j].click();
                }
            }

            if(input && output){
                output.innerHTML = input.value.trim();
                window.typesetInput = function () {
                    // button.disabled = true;
                    output.innerHTML = input.value.trim();
                    MathJax.texReset();
                    MathJax.typesetClear();
                    MathJax.typesetPromise([output]).catch(function (err) {
                        output.innerHTML = '';
                        output.appendChild(document.createTextNode(err.message));
                        console.error(err);
                    }).then(function () {
                        // button.disabled = false;
                    });
                }
                input.oninput = typesetInput;
            }
            return MathJax.startup.defaultPageReady();
        },
    },
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        processEscapes: true
    }
}

if(ckeditorToMathjaxBtns){
    for (var i = 0; i < ckeditorToMathjaxBtns.length; i++) {
        ckeditorToMathjaxBtns[i].addEventListener('click', function(e){
            e.preventDefault();
            var el = e.target;
            var previewId = el.getAttribute('data-preview');
            var previewEl = (previewId?.length) ? document.getElementById(previewId) : null;
            var sourceId = el.getAttribute('data-source-id');
            if(previewEl && appCkEditors && appCkEditors.length){
                if(sourceId?.trim().length){
                    var sourceEl = document.getElementById(sourceId);
                    previewEl.innerHTML = sourceEl.value;
                    el.disabled = true;
                    el.textContent = 'Please wait..';
                    MathJax.texReset();
                    MathJax.typesetClear();
                    MathJax.typesetPromise([previewEl]).catch(function (err) {
                        previewEl.innerHTML = '';
                        previewEl.appendChild(document.createTextNode(err.message));
                        console.error(err);
                    }).then(function () {
                        el.disabled = false;
                        el.textContent = 'Render';
                    });
                } else {
                    var name = el.getAttribute('data-name');
                    for (var i = 0; i < appCkEditors.length; i++) {
                        if(appCkEditors[i].name == name){
                            var content = appCkEditors[i].editor.getData();
                            previewEl.innerHTML = content;
                            el.disabled = true;
                            el.textContent = 'Please wait..';
                            MathJax.texReset();
                            MathJax.typesetClear();
                            MathJax.typesetPromise([previewEl]).catch(function (err) {
                                previewEl.innerHTML = '';
                                previewEl.appendChild(document.createTextNode(err.message));
                                console.error(err);
                            }).then(function () {
                                el.disabled = false;
                                el.textContent = 'Render';
                            });
                        }
                    }
                }
            } else {
                console.log(previewEl, appCkEditors );
            }
        });
    }
}