<!DOCTYPE html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
<style>
/* === CSS RESET === */
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}
ol, ul {
    list-style: none;
}
blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after, q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
/* === End of CSS RESET === */
/*@import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);*/

body {
    background: #555;
    color: white;
    font-size: 20px;
    font-family: 'Nanum Gothic', sans-serif;
    text-shadow: 
        1px 1px 0 transparent,
        2px 2px 0 #101010;
    overflow: hidden;
}
h1 {
    font-size: 75px;
    font-weight: bold;
    line-height: 1.5em;
    text-shadow: 
        2px 2px 0 transparent,
        4px 4px 0 #101010;
}

a, a:visited {
    color: white;
    text-decoration: none;
    border-bottom: 2px dotted;
    transition: color 0.2s;
}

a:hover {
    color: #AAA;
}

a:active {
    color: lightblue;
}

.big {
    display: block;
    font-size: 30px;
    
    line-height: 150%;
    margin-bottom: 10px;
    text-shadow: 
        1px 1px 0 transparent,
        2px 2px 0 #101010;
}

.wrapper div {
    position: absolute;
}

.settings, nav {
    position: fixed;
    z-index: 9999999;
    bottom: 0;
    background: rgba(10,10,10, 0.5);
    font-family: Helvetica, Arial, sans-serif;
    font-weight: normal;
    font-size: 20px;
}

.settings {
    right: 0px;
    padding: 10px 20px;
    border-radius: 10px 0 0 0;
}

.settings a {
    border: none;
}

nav {
    left: 0;
    border-radius: 0 10px 0 0;
}

nav li {
    float: left;
}

nav a {
    display: block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border: none;
    text-align: center;
    transition: 0.25s;
}

nav li:last-child a {
    border-radius: 0 10px 0 0;
}

nav a:hover {
    background: rgba(15,15,15, 0.5);
}

.sp-canvas {
    display: none;
}

.arrow {
    position: relative;
    display: inline-block;
}

.demo { 
    width: 800px;
    font-size: 30px;
    text-align: center;
    font-weight: bold;
}

.demo .arrow {
    font-size: 20px;
    animation: point-down 0.5s alternate infinite;
}

.description {
    top: 740px;
    left: 180px;
    width: 440px;
}

.syntax {
    top: 1510px;
    left: 430px;
    width: 400px;
}

.scrollbar {
    top: 1540px;
    left: 1600px;
    width: 400px;
}

.rotations {
    left: 2185px;
    top: 660px;
    width: 460px;
    transform: rotate(-90deg) translateY(2.5em);
}

.rotations .upside-down {
    font-size: 42px;
    text-align: right;
    transform: rotate(180deg) translateY(3em);
}

.source {
    left: 2200px;
    top: -800px;
    width: 400px;
    transform: rotate(90deg) translateX(50px);
}

.follow {
    width: 475px;
    left: 1100px;
    top: -950px;
    transform: rotate(90deg) translateX(50px);
}

.follow .big {
    font-size: 40px;
}

.highlight {
    animation: highlight 0.2s alternate 6 ;
}

@keyframes point-down {
    from {
        top: 0;
    }
    to {
        top: 5px;
    }
}

@keyframes highlight {
    to {
        background: lightblue;
    }
}

/* =========================================
 *      Scroll bar styles for jQuery Scroll Path
 *                (http://joelb.me/scrollpath)
 *                   ========================================= */

.sp-scroll-bar {
    position: fixed;
    z-index: 9999;
    right: 0;
    top: 5%;
    width: 10px;
    height: 90%;
    border-radius: 5px;
}

.sp-scroll-bar:hover {
    background: white;
    background: rgba(255,255,255, 0.1);
}

.sp-scroll-bar .sp-scroll-handle {
    position: absolute;
    width: 100%;
    height: 50px;
    border-radius: inherit;
    background: gray;
    background: rgba(0,0,0,0.7);
}

.sp-scroll-bar .sp-scroll-handle:hover {
    background: black;
}

.wrapper div {
    position: absolute;
}
.demo { 
    width: 800px;
    font-size: 30px;
    text-align: center;
    font-weight: bold;
}
.desc {
    top: 740px;
    left: 180px;
    width: 440px;
}
.rotate {
    left: 2185px;
    top: 660px;
    width: 460px;
    transform: rotate(-90deg) translateY(2.5em);
}
</style>
<body>
        <div class="wrapper">
            <div class="demo">
                <span class="big">Parallax scrolling : Scroll Path jQuery plugin</span>
            </div>
            
            <div class="description">
                <span class="big" style="font-size:24px">패럴랙스 스크롤링  첫번째 예제입니다.</span><br />
                <span class="big" style="font-size:24px">해당 플러그인의 공식 데모를 <br />약간 수정한 내용입니다.</span>
            </div>

            <div class="syntax">
                <span class="big" style="font-size:18px;">이 플러그인은 스크롤이벤트가 발생했을시,<br /> 특정 궤도(Path)를 따라 브라우저의 뷰포트가 이동합니다. 우측하단의 Show Path를 클릭하시면 브라우저가 이동하는 궤도를 보실 수 있습니다.</span>
            </div>

            <div class="scrollbar">
                <span class="big" style="font-size:20px;">또한 커스텀스크롤바를 지원하며<br />특정 스크롤링 위치에서의 <br />콜백함수를 지원합니다.</span>
                <span class="big" style="font-size:20px;"><br />해당섹션과 이전섹션으로 이동할 때<br />스크롤과 하단메뉴가 하이라이트 됩니다.</span>
            </div>

            <div class="rotations">
                <span class="big" style="font-size:24px"><a href="http://caniuse.com/#feat=transforms2d">지원 가능한</a> 브라우저에 한해</span>
                <span class="upside-down big" style="font-size:24px;">브라우저 뷰포트의 회전도 지원합니다.</span>
            </div>

            <div class="source">
                <span class="big">자세한 내용은 <a href="https://github.com/JoelBesada/scrollpath">GitHub</a>에서 보실 수 있습니다.<span>
            </div>

            <div class="follow">
                <span class="big" style="font-size:24px;">스크롤을 순환시킬 수 있습니다.<br/>스크롤을 내리며 우측의 스크를바를 보세요</span>
            </div>
        </div>

<script src="/static/js/jquery.scrollpath.js"></script>
<script>
$(document).ready(init);

function init() {
    /* ========== DRAWING THE PATH AND INITIATING THE PLUGIN ============= */

    $.fn.scrollPath("getPath")
        // Move to 'start' element
        .moveTo(400, 50, {name: "start"})
        // Line to 'description' element
        .lineTo(400, 800, {name: "description"})
        // Arc down and line to 'syntax'
        .arc(200, 1200, 400, -Math.PI/2, Math.PI/2, true)
        .lineTo(600, 1600, {
            callback: function() {
                highlight($(".settings"));
            },
            name: "syntax"
        })
        // Continue line to 'scrollbar'
        .lineTo(1750, 1600, {
            callback: function() {
                highlight($(".sp-scroll-handle"));
            },
            name: "scrollbar"
        })
        // Arc up while rotating
        .arc(1800, 1000, 600, Math.PI/2, 0, true, {rotate: Math.PI/2 })
        // Line to 'rotations'
        .lineTo(2400, 750, {
            name: "rotations"
        })
        // Rotate in place
        .rotate(3*Math.PI/2, {
            name: "rotations-rotated"
        })
        // Continue upwards to 'source'
        .lineTo(2400, -700, {
            name: "source"
        })
        // Small arc downwards
        .arc(2250, -700, 150, 0, -Math.PI/2, true)

        //Line to 'follow'
        .lineTo(1350, -850, {
            name: "follow"
        })
        // Arc and rotate back to the beginning.
        .arc(1300, 50, 900, -Math.PI/2, -Math.PI, true, {rotate: Math.PI*2, name: "end"});

    // We're done with the path, let's initate the plugin on our wrapper element
    $(".wrapper").scrollPath({drawPath: true, wrapAround: true});

    // Add scrollTo on click on the navigation anchors
    $("nav").find("a").each(function() {
        var target = $(this).attr("href").replace("#", "");
        $(this).click(function(e) {
            e.preventDefault();
            
            // Include the jQuery easing plugin (http://gsgd.co.uk/sandbox/jquery/easing/)
            // for extra easing functions like the one below
            $.fn.scrollPath("scrollTo", target, 1000, "easeInOutSine");
        });
    });

    /* ===================================================================== */

    $(".settings .show-path").click(function(e) {
        e.preventDefault();
        $(".sp-canvas").toggle();
    });

    
}


function highlight(element) {
    if(!element.hasClass("highlight")) {
        element.addClass("highlight");
        setTimeout(function() { element.removeClass("highlight"); }, 2000);
    }
}
function ordinal(num) {
    return num + (
        (num % 10 == 1 && num % 100 != 11) ? 'st' :
        (num % 10 == 2 && num % 100 != 12) ? 'nd' :
        (num % 10 == 3 && num % 100 != 13) ? 'rd' : 'th'
    );
}
</script>
</body>
</html>
