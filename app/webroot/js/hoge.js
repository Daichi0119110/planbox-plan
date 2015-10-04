console.log("hoge");
var carouObj = new Object();
carouObj.width = 1050;
carouObj.items = 3;
carouObj.auto = 5000;
carouObj.prev = ".left.carousel-control";
carouObj.next = ".right.carousel-control";
$("#thumbNails").carouFredSel(carouObj);

ChangeTab('tab1');

function ChangeTab(tabname) {
   // 全部消す
   document.getElementById('tab1').style.display = 'none';
   document.getElementById('tab2').style.display = 'none';
   document.getElementById('tab3').style.display = 'none';
   // 指定箇所のみ表示
   document.getElementById(tabname).style.display = 'block';
}