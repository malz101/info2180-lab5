"use strict";

window.onload=function() {
    const btn = document.querySelector('#controls button');
    

    btn.addEventListener('click',searchSubmit);

    function searchSubmit(e){
        e.preventDefault();
        let message = document.querySelector("#message");
        message.textContent=""
        let input = document.querySelector("#controls input#country").value;
        let valid_string=/[^( ,\.\-\(\)\w)]+/g;
        //let valid_string=/[^(\w)]+/g;

        input=input.trim();
        if(!(valid_string.test(input))){
            let url = `world.php?country=${input}`;
            fetch(url)
            .then(response=>{
                if (response.ok){
                    return response.text();
                }else{
                    return Promise.reject('something went wrong');
                }
            })
            .then(data=>{
                let result = document.querySelector("#result");
                result.innerHTML=data;
            })
            .catch(error=>console.log("There was an error "+error));
        }else{
            message.textContent = "Please enter a valid name. Name should not contain any special characters.";
            message.style.color="red";
        }
        //end if valid string
        
    }//search submit

}//end onload