<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>HOME</title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="/static/js/kakao.link.js"></script>
<script type="text/javascript">
  function executeKakaoStoryLink()
  {
    kakao.link("story").send({   
        post : "http://color106.egloos.com/ 카카오 스토리 첫글!",
        appid : "color106.egloos.com/m",
        appver : "1.0",
        appname : "거위의꿈",
        urlinfo : JSON.stringify({
        	title:"카카오 스토리", 
        	desc:"이게 잘 될까용?", 
        	imageurl:["http://pds25.egloos.com/logo/201310/15/79/e0016579.jpg"], 
        	type:"article"
        })
    });
  }
  function executeURLLink()
  {
      /* 
      msg, url, appid, appname은 실제 서비스에서 사용하는 정보로 업데이트되어야 합니다. 
      */
      kakao.link("talk").send({
          msg : "카카오 톡 링크 첫글! \nGood?",
          url : "http://color106.egloos.com/",  
          appid : "color106.egloos.com/m",
          appver : "1.0",
          appname : "거위의꿈",
          type : "link"
      });
  }
  $(function() {
  	$('#kakaostory').click(function() { executeKakaoStoryLink(); });
  	$('#kakaolink').click(function() { executeURLLink(); });
  });
  </script>
</head>
<body>
<button id="kakaostory">KAKAO STORY</button><br>
<button id="kakaolink">KAKAO TALK LINK</button>
</body>
</html>
