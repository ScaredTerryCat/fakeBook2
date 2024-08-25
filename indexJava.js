let changeColor=true;
function change(){
const b1=document.getElementById("b1");
const b2=document.getElementById("b2");
const b3=document.getElementById("b3");
const red=document.getElementById("red");
const blue=document.getElementById("blue");
const green=document.getElementById("green");
b1.addEventListener("mouseover",function(){b1.style.backgroundColor="black";b1.style.color="white";changeColor=false;});
b2.addEventListener("mouseover",function(){b2.style.backgroundColor="black";b2.style.color="white";changeColor=false;});
b3.addEventListener("mouseover",function(){b3.style.backgroundColor="black";b3.style.color="white";changeColor=false;});
b1.addEventListener("mouseout",function(){b1.style.color="black";b1.style.backgroundColor="white";changeColor=true;});
b2.addEventListener("mouseout",function(){b2.style.color="black";b2.style.backgroundColor="white";changeColor=true;});
b3.addEventListener("mouseout",function(){b3.style.color="black";b3.style.backgroundColor="white";changeColor=true;});
if(changeColor==true){
if(red.style.color=="red"){
red.style.color="lightgreen";
green.style.color="blue";
blue.style.color="red";
b1.style.backgroundColor="lightgreen";
b2.style.backgroundColor="blue";
b3.style.backgroundColor="red";
}
else if(red.style.color=="lightgreen"){
red.style.color="blue";
green.style.color="red";
blue.style.color="lightgreen";
b1.style.backgroundColor="blue";
b2.style.backgroundColor="red";
b3.style.backgroundColor="lightgreen";
}
else{
red.style.color="red";
green.style.color="lightgreen";
blue.style.color="blue";
b1.style.backgroundColor="red";
b2.style.backgroundColor="lightgreen";
b3.style.backgroundColor="blue";
}
}
}
setInterval(change,1000);
