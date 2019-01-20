var openNav=document.getElementById('open-nav');
var closeNav=document.getElementById('close-nav');
var navigationBar=document.getElementById('nav-side');

openNav.onclick=function(){navigationBar.style.width="100%";};
closeNav.onclick=function(){ navigationBar.style.width="0";};
