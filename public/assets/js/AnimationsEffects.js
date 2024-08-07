const AnimationsEffects = {

    formLogin : document.getElementsByClassName('form-login')[0],
    messageFlash : document.getElementsByClassName('flash')[0],

    handleScrollView(){
        if (this.messageFlash) {
            this.messageFlash.style.top = "0";
            setTimeout(() => {
                this.messageFlash.style.top = "-10em";
            }, 4000);
            setTimeout(() => {
                this.messageFlash.remove();
            }, 6000)
            this.messageFlash.scrollIntoView(true);
        }else if(this.formLogin) {
            this.formLogin.scrollIntoView(false)
        }else{
            return false;
        }
    }

}

animate = AnimationsEffects;

animate.handleScrollView();