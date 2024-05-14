<x-app-layout mathjax="1" title="MathJax">
    <div class="container max-w-4xl mx-auto px-3 py-10">
        <p>Type text in the box below. The text you enter is actually HTML, so you can include tags if you want; but this also means you have to be careful how you use less-than signs, ampersands, and other HTML special characters within your math (surrounding them by spaces should be sufficient).</p>
        <textarea rows="4" id="MathInput" title="MathJax Input" class="w-full rounded-md">When \(a \ne 0\), there are two solutions to \(ax^2 + bx + c = 0\) and they are
            \[x = {-b \pm \sqrt{b^2-4ac} \over 2a}.\]</textarea>
        <button id="renderHTML" class="border-0 py-0 bg-transparent text-sm">Render HTML</button>
        <div class="px-3 py-3 rounded-md shadow-sm bg-white" id="MathPreview"></div>
    </div>
</x-app-layout>