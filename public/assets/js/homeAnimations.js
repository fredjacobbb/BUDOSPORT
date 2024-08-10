const HomeAnimations = {

    cards : document.getElementsByClassName('discipline-card'),

    displayCard(card){
        let carDoc = document.getElementsByClassName(card);

        setInterval(() => {
            carDoc[0].classList.remove('d-none');
        }, 2000)
        
        // carDoc.classList.remove('d-none');
    },

    init(){
        var i = 0;
        for (const card of this.cards) {
            if (card.classList.contains(`card-${i}`)) {
                this.displayCard(`card-${i}`);
                i++;
            } else{
                alert(card)
            }
        }
    }

}

const homeAnimation = HomeAnimations;

homeAnimation.init()