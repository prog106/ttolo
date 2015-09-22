<? $this->load->view('project/head'); ?>
<script>
    $(document).bind('pagecreate',function(){
        if( navigator.geolocation == undefined ) {
            alert(" 위치 정보를 이용할 수 없습니다. ");
            return; 
        }
        //  지도를 보여줄 div 참조객체 얻어오기 
        var myMap = document.getElementById("myMap");
        var loc = new google.maps.LatLng(37.480484,126.98199550000001);
        //  div 에 구글맵 보이기
        var gmap = new google.maps.Map(
                myMap,  //지도가 보여질 div
                {
                    zoom:16,//  지도 확대 정보
                    center:loc, //  지도 중앙   위치
                    mapTypeId:google.maps.MapTypeId.ROADMAP //  지도타입
                }
        );
        //  위치에 마커 표시하기
        var gmarker = new google.maps.Marker(
            {
                position:loc,
                map:gmap,
                title:"우리 영화관"
            }
        );
    });
</script>

<div data-role="page">
    <div data-role="header" data-theme="c">
        <h2>우리 영화관</h2>
        <div data-role="navbar">
            <ul>
                <li><a href="#">위치보기</a></li>
                <li><a href="#">예매하기</a></li>
            </ul>
        </div>
    </div>
    <div data-role="content">
        <div style="text-align: center">
            <h3>우리 영화관 위치</h3>
            <div id="myMap" style="width:90%;height: 500px;margin: auto">
            </div>
        </div>
    </div>
</div>
</body>
</html>
