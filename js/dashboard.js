$(function(){
    let menuToggle = document.querySelector('.opener');
    let navigation = document.querySelector('.navigation');
    let content = document.querySelector('.content');
    menuToggle.onclick = function(){
        menuToggle.classList.toggle('active');
        navigation.classList.toggle('active');
        content.classList.toggle('active');
    }

    let list = document.querySelectorAll('.list');
    for (let i=0; i<list.length; i++){
        list[i].onclick = function(){
            $('.navigation').removeClass('active');
            $('.opener').removeClass('active');
            let j=0;
            while(j < list.length){
                list[j++].className = 'list';
            }
            list[i].className = 'list active';
        }
    }
});

