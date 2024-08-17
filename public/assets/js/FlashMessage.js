const FlashMessage = {

    formLogin : document.getElementsByClassName('form-login')[0],
    messageFlash : document.getElementsByClassName('flash')[0],

    handleScrollView(){
        if (this.messageFlash) {
            this.messageFlash.style.top = "-10em";
            this.messageFlash.style.top = "0em";
            setTimeout(() => {
                this.messageFlash.style.top = "-10em";
            }, 4000);
            setTimeout(() => {
                this.messageFlash.style.top = "-10em";
                this.messageFlash.style.display = "none";
            }, 6000)
            this.messageFlash.scrollIntoView(true);
        }else if(this.formLogin) {
            this.formLogin.scrollIntoView(false)
        }else{
            return false;
        }
    }

}

flashMessage = FlashMessage;

flashMessage.handleScrollView();