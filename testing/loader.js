window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");
    const page = document.querySelector(".page");
    
    loader.addEventListener("transitionend", () => {
        //document.body.removeChild("loader");
        page.classList.add("page-show");

    })

    setTimeout(() => {
        loader.classList.add("loader-hidden");
    }, 4000);
    
})