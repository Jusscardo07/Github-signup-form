const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendbtn = form.querySelector("button"),
ChatBox = document.querySelector(".chat-box");


form.onsubmit = (e) =>{
    e.preventDefault(); //statement preventing form from submitting
}
sendbtn.onclick = ()=>{
 // let's start with the Ajax code
 let xhr = new XMLHttpRequest();  //creating XML object
 xhr.open("POST", "php/insert-chat.php", true);
 xhr.onload = ()=>{
  if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        inputField.value = ""; //once message inserted into database then leave blank on the input field
        scrollToBottom();
      }
  }
 }
 //we have to send form data throug ajax to php
 let formData = new FormData(form); //creating new formData object 
 xhr.send(formData); //sending the form data to php

}

//interval work
setInterval(() => {
    // let's start with the Ajax code
   let xhr = new XMLHttpRequest();  //creating XML object
   xhr.open("POST", "php/get-chats.php", true);
   xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            ChatBox.innerHTML = data;
            scrollToBottom();
        }
    }
   }
    //we have to send form data throug ajax to php
 let formData = new FormData(form); //creating new formData object 
 xhr.send(formData); //sending the form data to php

 }, 500); //this function will frequentlu after 500ms;

function scrollToBottom(){
    ChatBox.scrollTop = ChatBox.scrollHeight;  
}