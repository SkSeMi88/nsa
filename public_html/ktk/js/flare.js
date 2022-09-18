function flare() {
  $('a.button').addClass('flareBtn');
}
setTimeout(flare, 2000);

function flareChange() {
  $('a.button').removeClass('flareBtn').addClass('flareBtn2');
}
setTimeout(flareChange, 2400);

function flareChange2() {
  $('a.button').removeClass('flareBtn2').addClass('flareBtn');
}
setTimeout(flareChange2, 10000);

function flareChange3() {
  $('a.button').removeClass('flareBtn').addClass('flareBtn2');
}
setTimeout(flareChange3, 11000);

function flareChange4() {
  $('a.button').removeClass('flareBtn2').addClass('flareBtn');
}
setTimeout(flareChange4, 17000);

function flareChange5() {
  $('a.button').removeClass('flareBtn').addClass('flareBtn2');
}
setTimeout(flareChange5, 18000);
