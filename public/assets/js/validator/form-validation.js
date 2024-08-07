
FormValidation = {

    ruleNameFirstnameInput : {
        'regex' : new RegExp(/^[A-Za-z][\p{L}-]*$/u),
        'min' : 1,
        'max' : 50,
    },
    nameInput : document.getElementsByName('name')[0],
    firstnameInput : document.getElementsByName('firstname')[0],

    rulePasswordInput : {
        'name' : 'password',
        'regex' : new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\/]).{12,255}$/u),
        'min' : 12,
        'max' : 255
    },
    passwordInput : document.getElementsByName('password')[0],
    rePasswordInput : document.getElementsByName('password-retyped')[0],

    checkInput(rule,input){ 
        if(rule.name === 'password'){
            if (input.value.length < 3) {
                throw new Error("")            
            }
            let regexUppercase = new RegExp(/^(?=.*[A-Z]).*$/);
            let regexLowercase = new RegExp(/^(?=.*[a-z]).*$/);
            let regexNumber = new RegExp(/^(?=.*[0-9]).*$/);
            let regexSpecialChar = new RegExp(/^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\/]).*$/);
            if (!regexUppercase.test(input.value)) {
                throw new Error(`Une lettre capitale requise.`);
            }
            if (!regexLowercase.test(input.value)) {
                throw new Error(`Une lettre minuscule requise.`);
            }
            if (!regexNumber.test(input.value)) {
                throw new Error(`Un chiffre minimum requis.`);
            }
            if (!regexSpecialChar.test(input.value)) {
                throw new Error(`Un caractère special requis.`);
            }
            if (input.value.length < this.rulePasswordInput.min) {
                throw new Error("Le mot de passe doit être d'un minimum de 12 caractères.")            
            }
            // Check if we are on form-registration || form-login
            if (this.rePasswordInput) {
                if (this.passwordInput.value !== this.rePasswordInput.value) {
                    throw new Error(`Les mots de passes ne correspondent pas.`);
                }
            }
        }else{
            if (!input.value.length >= rule.min && !input.value.length <= rule.max) {
                throw new Error(`La chaine doit être d' ${rule.min} caractère minimum et 50 maximum.`);
            }
            if (!rule.regex.test(input.value)) {
                throw new Error(`Le format n'est pas compatible.`);
            }
        }
        return true;
    },

    domHandler(rule,input,msg_error){
        try {
            if(FormValidation.checkInput(rule,input)){
                document.getElementsByClassName(msg_error)[0].innerText = ''
                document.getElementsByClassName('btn-registration')[0].removeAttribute('disabled');
            }
        }catch(err){            
            document.getElementsByClassName(msg_error)[0].innerText = `${err.message}`
            document.getElementsByClassName('btn-registration')[0].setAttribute('disabled', 'true');
        }
    }
    
}

if (FormValidation.nameInput) {
    FormValidation.nameInput.addEventListener('keyup', () => {
        FormValidation.domHandler(FormValidation.ruleNameFirstnameInput, FormValidation.nameInput,'error-message-name')
    });
}

if (FormValidation.firstnameInput) {
    FormValidation.firstnameInput.addEventListener('keyup', () => {
        FormValidation.domHandler(FormValidation.ruleNameFirstnameInput, FormValidation.firstnameInput, 'error-message-firstname')
    });
}

if (FormValidation.passwordInput) {
    FormValidation.passwordInput.addEventListener('keyup', () => {
        FormValidation.domHandler(FormValidation.rulePasswordInput, FormValidation.passwordInput, 'error-message-password');    
    })
}


if (FormValidation.rePasswordInput) {
    FormValidation.rePasswordInput.addEventListener('keyup', () => {
        FormValidation.domHandler(FormValidation.rulePasswordInput, FormValidation.rePasswordInput, 'error-message-password');    
    })
}




