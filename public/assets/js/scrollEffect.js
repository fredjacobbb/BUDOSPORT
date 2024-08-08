
gsap.registerPlugin(ScrollTrigger);

gsap.fromTo('.title-block',
    { x:-500},
    { x:0 , duration : 2,scrollTrigger: {
        trigger: '.title-block',
        toggleActions: 'restart pause reverse none'
    }},
)

