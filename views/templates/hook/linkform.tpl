<!-- Block mymodule -->
<div id="mymodule_block_home" class="block">
  <h4>Mon formulaire santé !</h4>
  <div class="block_content">
    <p>
      {$my_module_message}
    </p>
    <a href="{$my_module_link}" title="Click this link" class="link-mcp">Remplir le formulaire</a>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    var check = "{$my_module_check}";
    console.log(check);
    if (!check) {
      $('.cart_navigation .standard-checkout').addClass('disabled').attr('disabled');
    }
  });
</script>
<!-- /Block mymodule -->
