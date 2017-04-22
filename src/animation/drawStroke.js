
     import anime from 'animejs'
     import $ from 'jquery'

     export default function drawStroke(selector, callback) {
       const timer = anime.random(500, 1180)
       $(selector).css({
         stroke: 'rgba(255,255,255,1)',
         'stroke-opacity': '1',
         'stroke-width': '5px',
         opacity: 1,
         'fill-opacity': 0
       })
       anime({
         targets: selector,
         strokeDashoffset: {
           value: el => {
             const pathLength = el.getTotalLength()
             el.setAttribute('stroke-dasharray', pathLength)
             return [-pathLength, 0]
           },
           easing: 'linear',
           delay: (e, i) => i * anime.random(150, 450)
         },
         strokeWidth: {
           value: ['2px', '3px'],
           delay: (e, i) => i * anime.random(152, 450)
         },
         elasticity: anime.random(300, 500),
         duration: timer,
         begin: (e) => {
           setTimeout(() => {
             anime({
               targets: selector,
               fillOpacity: {
                 value: [0, 1],
                 delay: (e, i) => i * 70,
                 duration: 2700
               },
               strokeOpacity: {
                 value: [1, 0.1],
                 delay: (e, i) => i * 180,
                 duration: 3700
               }
             })
           }, timer + 100)
         //  if (callback) callback(e);
         }
       })
     }
