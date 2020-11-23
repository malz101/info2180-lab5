"use strict";

window.onload=function() {
    const con_btn = document.querySelector('#controls #lookup');
    const city_btn = document.querySelector('#controls #lookup-cities');
    
    con_btn.context="countries";
    city_btn.context="cities";
    
    con_btn.addEventListener('click',searchSubmit);
    city_btn.addEventListener('click',searchSubmit);
    

    function searchSubmit(e){
        e.preventDefault();
        let context = e.currentTarget.context;
        let message = document.querySelector("#message");
        let input = document.querySelector("#controls input#country").value;
        let valid_string=/[^( ,\.\-\(\)\w)]+/g;
       
        message.textContent=""
        input=input.trim();

        if(!(valid_string.test(input))){
            let url = `world.php?country=${input}&context=${context}`;
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
        }
        //end if valid string
        
    }//search submit

}//end onload