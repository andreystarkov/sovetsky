import anime from 'animejs'
import $ from 'jquery'

export default function drawPath(selector, callback, options = {
      duration: 1500,
      loop: false,
      easing: 'linear'
    }){

    var totalLength = $(selector)[0].getTotalLength() || 1000;

   //console.log('drawPath: ', $(selector)[0].getTotalLength(), $(selector).getTotalLength());

    $(selector).css({
      'stroke': '#111',
      'stroke-width': '2px',
      'stroke-opacity': '0',
      'fill': 'transparent',
      'stroke-dasharray': totalLength,
      'stroke-dashoffset': totalLength
    });

    anime({
      targets: selector,
      ...options,
      strokeDashoffset: 0,
      strokeOpacity: 1,
      complete: () => {
        if(callback) callback();
      }
    });
}
