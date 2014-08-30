<div class="row">
  <div class="col-lg-8 col-md-8">

    <? $this->load->view('posts/post_box') ?>

    <? if($show_follow_msg): ?>
    <div id="no-following-message" class="panel panel-default">
      <h3>You aren't following anyone, <?=session_get('username')?></h3>
      <p>Follow people to see their debates on your dashboard.</p>
      <a href="<?=base_url('people/list/popular')?>" class="btn btn-success">View Popular People</a>
      <br>
      <br>
      <a href="<?=base_url('people/alphasquare')?>" class="btn btn-default">Follow Alphasquare</a>

    </div>
    <? endif; ?>

    <div id="posts" data-type="dashboard">
      <?=$posts_html?>
    </div>
    <? $this->load->view('posts/loading') ?>

  </div>

  <div class="col-lg-4 col-md-4" id="sidebar">
    <? $this->load->view('sidebar/main', array('dashboard'=>'true')) ?>
    <? $this->load->view('sidebar/follows') ?>
  </div>

</div>

<script src="<?=base_url('assets/js/dashboard.js')?>"></script>