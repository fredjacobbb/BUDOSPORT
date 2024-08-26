gsap.registerPlugin(ScrollTrigger);

gsap.fromTo('.title-block',
    { x: -1000 }, // Starting position
    { x: 0, duration: 3,
      scrollTrigger: {
        trigger: '.title-block',
        start: 'top 90%', // Start animation when the top of the trigger is 80% from the top of the viewport
        end: 'top 40%', // End animation when the top of the trigger is 50% from the top of the viewport
        scrub: true // Smoothly syncs the animation with scrolling
      },
      onComplete: () => {
        
      },
    },
);

gsap.fromTo('.title-block-2',
  { x: 1000 }, // Starting position
  { x: 0, duration: 3,
    scrollTrigger: {
      trigger: '.title-block-2',
      start: 'top 90%', // Start animation when the top of the trigger is 80% from the top of the viewport
      end: 'top 40%', // End animation when the top of the trigger is 50% from the top of the viewport
      scrub: true // Smoothly syncs the animation with scrolling
    },
    onComplete: () => {
      
    },
  },
);

// DASHBOARD

const buttons = document.getElementsByClassName("next");
const container = document.getElementsByClassName("dashb-container")[0];

for(let button of buttons){
  button.onclick = () => {  
    container.scrollLeft += (window.innerWidth);
    console.log();
    
  };
}



