
if (document.getElementById('pgBar')) {
    var score = document.getElementById('pgBar').getAttribute('percentage-score');
    var nbTechniques = document.getElementById('pgBar').getAttribute('data-techniques');
    var nbvalidTechniques = document.getElementById('pgBar').getAttribute('data-valid');
    
    var circle = new ProgressBar.Circle('#pgBar', {
        color: '#a41c27',
        strokeWidth: 6,
        duration: 2000,
        easing: 'easeInOut',
        text: {
            value: nbvalidTechniques + '/' + nbTechniques
        }
    });
    
    circle.text.style.fontFamily = '"gotham", Helvetica, sans-serif';
    
    circle.animate(score / 100);
}
