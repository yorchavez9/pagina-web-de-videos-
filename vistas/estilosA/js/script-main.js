 const showMenu = (headerToggle, navbarId) => {
   const toggleBtn = document.getElementById(headerToggle),
     nav = document.getElementById(navbarId)

   if (headerToggle && navbarId) {
     toggleBtn.addEventListener('click', () => {
       nav.classList.toggle('show-menu')
       toggleBtn.classList.toggle('fa-times')
     })
   }
 }
 showMenu('header-toggle', 'navbar')

 const linkcolor = document.querySelectorAll('.nav_link');

 function colorLink() {
   linkcolor.forEach(l => l.classList.remove('active'))
   this.classList.add('active')
 }
 linkcolor.forEach(l => l.addEventListener('click', colorLink))




const btnMenu = document.getElementsByClassName("subMenu");
const menu = document.getElementsByClassName("subMenuB");

for(let clicks of btnMenu){
  clicks.addEventListener("click", function(){
    for(let subClick of menu){
      subClick.classList.toggle("mostrar_Sub_menu")
    }
  })
}
