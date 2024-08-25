let dashbslide = document.getElementsByClassName('dashb-slide');
let dashbslideSched = document.getElementsByClassName('dashb-slide-sched');
let cardCategory = document.getElementsByClassName('card-category');
let accordionItem = document.getElementsByClassName('accordion-item');


for (let index = 0; index < accordionItem.length; index++) { 
    if(accordionItem[index].querySelector('.accordion-body').childElementCount < 1){
        accordionItem[index].style.display = 'none';
    }
}

for (let index = 0; index < dashbslide.length; index++) {
    if(dashbslide[index].childElementCount < 2){
        dashbslide[index].style.display = 'none'
    }
}

for (let i = 0;i < cardCategory.length;i++){
    if (cardCategory[i].childElementCount < 2) {
        cardCategory[i].style.display = 'none'
    }
}
