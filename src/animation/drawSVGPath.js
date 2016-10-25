import anime from 'animejs'
import $ from 'jquery'

export default function drawSVGPath(selector, callback, options = {
      duration: 5500,
      loop: false,
      easing: 'linear'
    }){

    var el= document.querySelector(selector),
        rect = el.getBoundingClientRect(),
        fill = $(el).attr('fill');

    var totalLength = (2 * Math.PI * rect.width);
   // console.log('drawPath: totalLength', totalLength);

    $(selector).css({
      'stroke': '#222',
      'stroke-opacity': '1'
    });

    anime({
      targets: selector,
      ...options,
      strokeDashoffset: {
        value: (e) => {
          return [ $(e)[0].getTotalLength(), 0 ];
        },
        duration: 2000
      },
      strokeWidth: {
        value: [1, 0],
        duration: 1200,
        delay: 1800
      },
      fill: {
        value: (e) => {
          return ['rgba(255,255,255,0)', '#d53d2e']
        },
        delay: 1500,
        duration: 1000
      },
      delay: function(el, index) {
        return index * 380
      },
      opacity: {
        value: [0, 1],
        duration: 1200,
      },
     // strokeDasharray: 0,
      strokeOpacity: 1,
      easing: 'easeInOutSine',
      complete: (e) => {

        if(callback) callback();
      }
    });
}
