      <!-- div class="jumbotron" style="background:url(<?=$bgimg[0];?>) no-repeat 50%;background-size:100%;height:<?=$bgimg[1];?>px;" -->
        <!-- h1>어서오세요!</h1 -->
        <!-- p class="lead">또로 프로젝트 홈페이지 입니다.<br> 참신하고 다양한, 그리고 <br>돈되는 아이디어를 기다리고 있습니다.<br>많은 관심 부탁드립니다.</p -->
        <!-- p><a class="btn btn-lg btn-success" href="/" role="button" target="_blank">모바일 페이지로 이동</a></p -->
      <!-- /div -->
      <div id="jumbotronslides" class="jumbotron" style="padding:0">
        <? foreach($bgimg as $k => $v) { ?>
          <img src="<?=$v[0];?>>" width="100%">
        <? } ?>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4><span class="glyphicon glyphicon-asterisk"></span> <a href="/lt" target="_blank">로또 프로젝트</a> <code class="btn-xs">mobile</code></h4>
          <p>6/45 로또 번호 6개를 랜덤하게 자동 생성</p>

          <h4><span class="glyphicon glyphicon-bookmark"></span> <a href="/go" target="_blank">개인링크 프로젝트</a> <code class="btn-xs">mobile</code></h4>
          <p>내가 자주 이용하는 홈페이지 모음, 공유가 가능</p>

          <h4><span class="glyphicon glyphicon-usd"></span> <a href="/money" target="_blank">정총무 프로젝트</a> <code class="btn-xs">mobile</code></h4>
          <p>수입 지출 관리를 위한 가계부<br>또로벅스에서 사용중입니다.</p>

        </div>
        <div class="col-lg-6">
          <h4><span class="glyphicon glyphicon-cutlery"></span> <a href="/lt/swap" target="_blank">같이 밥먹기 프로젝트</a> <code class="btn-xs">mobile</code></h4>
          <p>서로 친해지기 위해 램덤으로 팀을 나누어 밥먹기</p>

          <h4><span class="glyphicon glyphicon-tint"></span> <a href="#">또로벅스 프로젝트</a> <code class="btn-xs">off-line</code></h4>
          <p>회사에서 커피를 좋아하는 사람들이 모여 하루 한잔 핸드드립 커피 마시기</p>

        </div>
      </div>

