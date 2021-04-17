<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">
var i = 0;

  $(function() {
      var $content = $('.field:last-child');
      $('.add_btn').on('click', function() {
i++;
          $content.clone(true).insertAfter('.parent').

          attr('id',i).  //上で取得した要素の中のidをiとする
          appendTo("#sort");

          $("#result").val(i);

          // $('#data').attr('value', i);
            //#rootsに追加

  }

);

$('#sort').sortable({
       update: function(){
     var log = $(this).sortable("toArray");
     $("#log").text(log);

       }
   });

//削除
  $('.trash_btn').on('click', function() {
        $(this).parents('.field').remove();
      });
  });


  </script>

  <style>

ul.jquery-ui-sortable {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 70%;
}
li.jquery-ui-sortable-item {
    margin: 5px;
    padding: 0.5em;
    border: 1px darkgray solid;
    border-radius: 5px;
    background-color: #fcfcfc;
}
li.jquery-ui-sortable-item div {
    padding: 0 0 0 1em;
    font-size: 15px;
    font-weight: bold;
    cursor: move;
    border-radius: 5px;
}
li.jquery-ui-sortable-item ul {
    font-size: 13px;
}

</style>
  </head>
  <body>
    <script>
        $(function(){
          $('#sort').sortable();
        }
      );

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>




  <button type="button"  class="btn bg-white mt10 miw100 add_btn" value="" name="">入力欄追加</button>
     <br>
     <br>
           <form method="post" action="dorag.check.php">
             <div id="sort"  class="parent">
                   <div class="field"  style="padding-bottom:8px; border-bottom:1px solid #ccc;margin-bottom:20px;" id="0">
<input type="text" id="result" name="result[]" value="0"/>
                       <ul class="jquery-ui-sortable" name="sort[]" value="1">
                           <li class="jquery-ui-sortable-item">
                             <div class="ui-state-default">項目 1</div>
                               <ul>
                                   <li>項目 1-1</li>
                                   <li>項目 1-2</li>
                                   <li>項目 1-3</li>
                               </ul>
                           </li>
                        </ul>
           <button type="button" class="btn trash_btn ml10" value="" name="">削除</button>
        </div>
        </div>
<p id="log" name="log[]"></p>

           <div><input type="submit" value=" 並び替え実行 " /></div>
       </form>

  </body>
</html>
