<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Quill</title>
    <!-- highlight.js を使う場合はquillの前に参照する-->
    <link rel="stylesheet"
          href="http://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
    <script src="http://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>



</head>
<body>


<!-- Create the editor container -->
<div id="editor">
    <p>Hello World!</p>
    <p>Some initial <strong>bold</strong> text</p>
    <p><br></p>
</div>
<!--<button id="btnContent">コンテンツ取得</button>-->
<!--<button id="btnImage">イメージの挿入</button>-->
<!--<button id="btnDisable">編集可能/不可能</button>-->

<script>
    var Delta = Quill.import('delta');
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            syntax : true,              // Include syntax module
            // https://quilljs.com/docs/modules/toolbar/
            toolbar : [
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image','video'] ,
                ['code-block']
            ]
        }
    });

    document.getElementById('btnContent').addEventListener('click', function() {
        console.log(quill.getContents());
    });

    document.getElementById('btnImage').addEventListener('click', function() {
        // このあたりを工夫すればクリップボードからの画像貼り付け等ができそう・・
        console.log(quill.getSelection(true).index);
        quill.insertEmbed(quill.getSelection(true).index, 'image', 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png');
    });

    let enableEditor = false;
    document.getElementById('btnDisable').addEventListener('click', function() {
        quill.enable(enableEditor);
        enableEditor = !enableEditor;
        console.log(enableEditor);
    });


    /**
     * ペーストのイベント追加例
     */
    quill.root.addEventListener("paste", function (t) {
        console.log('paste');
        console.log(t);
        return true;
    } , false);


</script>
</body>
</html>