const btnProfile = document.querySelector("#btn-profile");
const profile = document.getElementById("profile-0");
btnProfile.addEventListener("click",()=>{
    profile.classList.toggle("hidden");
});