//import aniEasings from '../animation/easings'
import anime from 'animejs'
import $ from 'jquery'

var aniEasings = [
  'easeInBack',
  'easeInBounce',
  'easeInCirc',
  'easeInCubic',
  'easeInElastic',
  'easeInExpo',
  'easeInOutBack',
  'easeInOutBounce',
  'easeInOutCirc',
  'easeInOutCubic',
  'easeInOutElastic',
  'easeInOutExpo',
  'easeInOutQuad',
  'easeInOutQuart',
  'easeInOutQuint',
  'easeInOutSine',
  'easeInQuad',
  'easeInQuart',
  'easeInQuint',
  'easeInSine',
  'easeOutBack',
  'easeOutBounce',
  'easeOutCirc',
  'easeOutCubic',
  'easeOutElastic',
  'easeOutExpo',
  'easeOutInBack',
  'easeOutInBounce',
  'easeOutInCirc',
  'easeOutInCubic',
  'easeOutInElastic',
  'easeOutInExpo',
  'easeOutInQuad',
  'easeOutInQuart',
  'easeOutInQuint',
  'easeOutInSine',
  'easeOutQuad',
  'easeOutQuart',
  'easeOutQuint',
  'easeOutSine',
  'linear'
];

export default function aniItemsRandom(selector, callback, maxDuration = 300, maxDelay = 120){

  var easing = aniEasings[anime.random(0,19)];

  var params = {
      targets: selector,
      fillOpacity: {
        value: [0,1],
        duration: anime.random(150,maxDuration)
      },
      opacity: [0,1],
      translateY: {
        value: () => {
          return [anime.random(400,10), 0]
        },
        duration: anime.random(150,maxDuration)
      },
      translateX: {
        value: () => {
          return [anime.random(400,10), 0]
        },
        duration: anime.random(150,maxDuration)
      },
      rotate: {
        value: () => {
          return [anime.random(10,90), 0]
        },
        duration: anime.random(150,maxDuration)
      },
      rotateX: {
        value: () => {
          return [anime.random(10,90), 0]
        },
        duration: anime.random(150,maxDuration)
      },
      rotateY: {
        value: () => {
          return [anime.random(10,90), 0]
        },
        duration: anime.random(150,maxDuration)
      },
      loop: false,
      easing: easing,
      delay: function(el, index) {
        return index * anime.random(10,maxDelay)
      },
      complete: (a) => {
       // $(selector).addClass('animated');
        if(callback) callback();
      }
    };

  //console.log('aniItemsRandom: '+selector, params);

  if( !$(selector).hasClass('animated') ) {
    $(selector).addClass('animated');
    anime(params);
  } else {
   // console.log('Already animated. Skipping');
  }

}
