window.MathJax = {
    startup: {
        pageReady: function () {
            var input = document.getElementById('MathInput');
            var output = document.getElementById('MathPreview');
            var button = document.getElementById('renderHTML');
            output.innerHTML = input.value.trim();
            window.typesetInput = function () {
                button.disabled = true;
                output.innerHTML = input.value.trim();
                MathJax.texReset();
                MathJax.typesetClear();
                MathJax.typesetPromise([output]).catch(function (err) {
                    output.innerHTML = '';
                    output.appendChild(document.createTextNode(err.message));
                    console.error(err);
                }).then(function () {
                    button.disabled = false;
                });
            }
            input.oninput = typesetInput;
            return MathJax.startup.defaultPageReady();
        },
    },
    tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        processEscapes: true
    }
}