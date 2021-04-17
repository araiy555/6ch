<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">

<h4 class="modal-title" id="myModalLabel">リンク共有</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<?php
$url = 'https://'.$_SERVER["HTTP_HOST"] .'/view?'.$_SERVER["QUERY_STRING"];
echo '<a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $val['id'] . '">Twiiterでシェアする</a>';
?>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
