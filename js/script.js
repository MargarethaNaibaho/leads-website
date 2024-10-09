const hamburger = document.querySelector("#toggle-btn");
const sidebarLinks = document.querySelectorAll(".sidebar-link"); 

hamburger.addEventListener("click", function(){
    sidebar.classList.toggle("expand");
    console.log("Sidebar toggled:", sidebar.classList.contains("expand"));
    // document.querySelector("#sidebar").classList.toggle("expand");
})

sidebarLinks.forEach(link => {
    link.addEventListener("click", function() {
        sidebarLinks.forEach(item => item.parentElement.classList.remove("active"));
        
        this.parentElement.classList.add("active");
    });
});