const searchbar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
usersList = document.querySelector(".users .user-list");

searchBtn.onclick = () => {
    searchbar.classList.toggle("active");
    searchbar.focus();
    searchBtn.classList.toggle("active"); 
    searchbar.value = "";
}
searchbar.onkeyup = ()=>{

    let searchTerm = searchbar.value;
    if(searchTerm!= ""){
        searchbar.classList.add("active");

    } else{
        searchbar.classList.remove("active");
    }

    // let's start with the Ajax code
   let xhr = new XMLHttpRequest();  //creating XML object
   xhr.open("POST", "php/search.php", true);
   xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            usersList.innerHTML = data;  
        }
    }
   }
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send("searchTerm=" + searchTerm);
}
 setInterval(() => {
    // let's start with the Ajax code
   let xhr = new XMLHttpRequest();  //creating XML object
   xhr.open("GET", "php/useRs.php", true);
   xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
           if(!searchbar.classList.contains("active")){ // if active the active  should not contain in search bar then add this data
            usersList.innerHTML = data;
           }
            
        }
    }
   }
   xhr.send();
 }, 500); //this function will frequentlu after 500ms;

 