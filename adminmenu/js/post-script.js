let updatePostEvent = document.querySelectorAll(".update-this-item");

let postId = document
.querySelector(".update-this-item")
.getAttribute("date-attributes");

updatePostEvent.forEach((e)=>{

    e.addEventListener("click", (e) => {
    
        console.log('hi');
    
        console.log(postId);
    
    })
})