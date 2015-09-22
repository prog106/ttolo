<style>
.ui-li-desc {white-space:normal;}
.st { position:absolute;top:50px;width:50px;border:0px solid #000;float:left;margin:10px;font-size:50pt; }
.goal { position:absolute;top:0px;width:150px;border:0px solid #000;float:left;margin:10px;font-size:0pt; }
.keeper { position:absolute;top:0px;width:50px;border:0px solid #000;float:left;margin:10px;font-size:30pt; }
#k2 { left:50px; }
#k3 { left:100px; }
#step2 { left:50px; }
#step3 { left:100px; }
.sec { width:50px;border:1px solid #000;float:left;margin:10px;font-size:50pt; }
.thi { width:50px;border:1px solid #000;float:left;margin:10px;font-size:50pt; }
.men { font-size:50px;position:absolute;width:200px;border:0px solid #000;top:200px; }
.cl { cursor:pointer; }
</style>
<div class="keeper" id="k1"></div>
<div class="keeper" id="k2"></div>
<div class="keeper" id="k3"></div>
<div class="st" id="step1"></div>
<div class="st" id="step2"></div>
<div class="st" id="step3"></div>
<div class="goal" id="step4">Goal!</div>
<div class="goal" id="step5">NoGoal..</div>
<div class="men">
<span class="cl" id="leftk"><</span> 
<span class="cl" id="go">ㅁ</span> 
<span class="cl" id="rightk">></span>
<div id="restart" style="display:none;cursor:pointer;">다시차기</div>
