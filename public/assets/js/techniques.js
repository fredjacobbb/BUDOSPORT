const selectTechniqueId = document.getElementsByClassName('select_technique_id');

const inputTechniqueId = document.getElementsByClassName('technique_id');

const disciplineContainer = document.getElementsByClassName('discipline-container');

const formTechniques = document.getElementsByClassName('form-techniques');

console.log(formTechniques);

let i = 1;


for(const formGrade of formTechniques){

    const editLink = formGrade.children[3].children[0];    
    const deleteLink = formGrade.children[3].children[1];    
    const select = formGrade[0];
    const inputHidden = formGrade[1];

    select.addEventListener('change', (e) => {
        inputHidden.value = e.target.value;
        
        editLink.href = "?real=admin&action=edit-technique&technique_id=" + e.target.value;
        deleteLink.href = "?real=admin&action=delete-technique&technique_id=" + e.target.value;

        console.log(inputHidden.value);
    })
    i++;
}