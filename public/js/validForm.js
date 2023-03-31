let img=document.getElementById("serie_image");
img.addEventListener("change" , function(event){
    console.log (event.target.value);
    let regex = /(\.png|\.jpg)$/;
    let image = event.target.value;
    let span = document.getElementById("error")
    let input = document.getElementById("ajout")
    if (image.search(regex) >-1)
    {
        console.log("image ok");
        span.innerHTML=""
        input.disabled=false;
    }
    else 
    {
        console.log("image nom valide");
        span.innerHTML="image non valide"
        input.disabled=true;
    }
})

img.addEventListener("change" , (event)=>{
    console.log (event.target.value)
})