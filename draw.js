
var drawFlag = false;
var oldX = 0;
var oldY = 0;
var dataurl;

var img;
var width, height;
var canvas, context;
var canvas2, context2;
var srcData, dstData;
var src, dst;
var dataurl;

var ofd = document.getElementById("selectfile");
ofd.addEventListener("change", function(evt){
  //var img = null;
  var canvas = document.createElement("canvas");

  var file = evt.target.files;
  var reader = new FileReader();

  reader.readAsDataURL(file[0]);

  reader.onload = function(){
    img = new Image();

    img.onload = function(){
      canvas = document.getElementById("canvas");
      context = canvas.getContext('2d');

      canvas.width = img.width;
      canvas.height = img.height;
      context.drawImage(img, 0, 0, img.width, img.height);
    }
    img.src = reader.result;
  }
}, false);

/*
window.addEventListener("load", function(){
    var can = document.getElementById("canvas");
    can.addEventListener("mousemove", draw, true);
    can.addEventListener("mousedown", function(e){
        drawFlag = true;
        oldX = e.clientX;
        oldY = e.clientY;
    }, false);
    can.addEventListener("mouseup", function(){
        drawFlag = false;
    }, false);
}, true);
// 描画処理
function draw(e){
    if (!drawFlag) return;
    var x = e.clientX;
    var y = e.clientY;
    var can = document.getElementById("canvas");
    var context = can.getContext("2d");
    context.strokeStyle = document.getElementById("page_strokeStyle").value;
    context.globalAlpha = document.getElementById("page_globalAlpha").value;
    context.lineWidth = document.getElementById("page_lineWidth").value;;
    context.beginPath();
    context.moveTo(oldX, oldY);
    context.lineTo(x, y);
    context.stroke();
    context.closePath();
    oldX = x;
    oldY = y;
}
*/

(function(){
        window.onload = function(){
          var canvas = document.getElementById('canvas');
          if(!canvas || !canvas.getContext){
            return false;
          }
          var ctx = canvas.getContext('2d');
          //マウスの座標を取得
          var mouse = {
            startX: 0,
            startY: 0,
            x: 0,
            y: 0,
            color: "black",
            isDrawing: false
          };
          var borderWidth = 1;
          canvas.addEventListener("mousemove", function(e){
            //2.マウスが動いたら座標値を取得
        		var rect = e.target.getBoundingClientRect();
        		mouse.x = e.clientX - rect.left - borderWidth;
        		mouse.y = e.clientY - rect.top - borderWidth;

            //4.isDrawがtrueのとき描画
        		if (mouse.isDrawing){
        			ctx.beginPath();
        			ctx.moveTo(mouse.startX, mouse.startY);
        			ctx.lineTo(mouse.x, mouse.y);
        			ctx.strokeStyle = document.getElementById("page_strokeStyle").value;
              ctx.globalAlpha = document.getElementById("page_globalAlpha").value;
              ctx.lineWidth = document.getElementById("page_lineWidth").value;;
              ctx.stroke();
        			mouse.startX = mouse.x;
        			mouse.startY = mouse.y;
        		}
          });
          //5.マウスを押したら、描画OK(myDrawをtrue)
          canvas.addEventListener("mousedown", function(e){
            mouse.isDrawing = true;
            mouse.startX = mouse.x;
            mouse.startY = mouse.y;
          });
          //6.マウスを上げたら、描画禁止(myDrawをfalse)
        	canvas.addEventListener("mouseup", function(e){
        		mouse.isDrawing = false;
        	});
          canvas.addEventListener('mouseleave', function(e){
            mouse.isDrawing = false;
          });
        }
      })();

// 保存処理　(Canvas2Image)
function saveData(){
    var can = document.getElementById("canvas");
    Canvas2Image.saveAsPNG(can);    // PNG形式で保存
}
