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

