const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errortxt = form.querySelector(".error-text");


form.onsubmit = (e) =>{
    e.preventDefault(); //statement preventing form from submitting
}

continueBtn.onclick = ()=>{
   // let's start with the Ajax code
   let xhr = new XMLHttpRequest();  //creating XML object
   xhr.open("POST", "php/LOgin.php", true);
   xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            console.log(data);
            
           if(data == "success"){
            location.href = "users.php";
           }else{
           errortxt.textContent = data;
           errortxt.style.display = "block";  
           }
        }
    }
   }
   //we have to send form data throug ajax to php
   let formData = new FormData(form); //creating new formData object

   xhr.send(formData); //sending the form data to php

}