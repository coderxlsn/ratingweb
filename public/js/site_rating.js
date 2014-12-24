window.onload = function() {
        canvas  = $('#site_rating'),
        percent = -canvas.data('completeness') * 10,
        ctx     = canvas.get(0).getContext('2d'),
        endAngle = (Math.PI * percent * 2 / 100);
        pos = 0;
    
    ctx.beginPath();
    ctx.fillStyle = "#fff";
    ctx.arc(82, 82, 75, 0, Math.PI * 2, false);
    ctx.fill();
    ctx.closePath();
    
    ctx.beginPath();
    ctx.fillStyle = "#d5d3bc";
    ctx.arc(82, 82, 35, 0, Math.PI * 2, false);
    ctx.fill();
    ctx.closePath();
    
    ctx.beginPath();
    ctx.lineWidth = 40;
    ctx.strokeStyle = ctx.fillStyle = "#de5b34";
    ctx.arc(82, 82, 55, endAngle - Math.PI/2, -(Math.PI/180*90), false);
    ctx.stroke();

    if (canvas.data('completeness').toString().length==1) {pos = 75}
    if (canvas.data('completeness').toString().length==2) {pos = 68}
    if (canvas.data('completeness').toString().length==3) {pos = 65}

    ctx.closePath();
    
    ctx.beginPath();
    ctx.fillStyle = "#de5b34";
    ctx.font = "22px os_bold"; 
    ctx.fillText(-percent / 10, pos, 90);
    ctx.closePath();
};
