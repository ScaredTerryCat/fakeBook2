const formC=document.getElementById("formContainer");
const form=document.getElementById("form");
const s1=document.getElementById("s1");
const s2=document.getElementById("s2");
const body=document.getElementById("body");
const username=document.getElementById("username");
const password=document.getElementById("password");
const submit=document.getElementById("submit");
function change(){
if(body.style.backgroundColor=="grey"){body.style.backgroundColor="black";
form.style.backgroundColor="blue";
s1.style.backgroundColor="red";
s2.style.backgroundColor="lightgreen";
username.placeholder=username.placeholder.toUpperCase();
password.placeholder=password.placeholder.toUpperCase();
submit.value=submit.value.toUpperCase();
submit.style.backgroundColor="black";
submit.style.color="green";
username.style.backgroundColor="skyblue";
password.style.backgroundColor="skyblue";
}
else{body.style.backgroundColor="grey";
form.style.backgroundColor="red";
s1.style.backgroundColor="lightgreen";
s2.style.backgroundColor="blue";
username.placeholder=username.placeholder.toLowerCase();
password.placeholder=password.placeholder.toLowerCase();
submit.value=submit.value.toLowerCase();
submit.style.backgroundColor="white";
submit.style.color="black";
username.style.backgroundColor="white";
password.style.backgroundColor="white";
}}
setInterval(change,1000);