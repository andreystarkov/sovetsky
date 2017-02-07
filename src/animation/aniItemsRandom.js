// import aniEasings from '../animation/easings'
import anime from 'animejs'
import $ from 'jquery'

const aniEasings = [
  'easeInBounce',
  'linear',
  // 'easeInQuad',
  // 'easeInQuart',
  // 'easeInQuint',
  'easeInSine',
  // 'easeInBack',
  'easeInBounce',
  'easeInElastic'
  // 'easeOutBack',
  // 'easeOutBounce',
  // 'easeOutCirc',
  // 'easeOutCubic',
  // 'easeOutElastic',
  // 'easeOutExpo',
  // 'easeOutInBack',
  // 'easeOutInBounce',
  // 'easeOutInCirc',
  // 'easeOutInCubic',
  // 'easeOutInElastic',
  // 'easeOutInExpo',
  // 'easeOutInQuad',
  // 'easeOutInQuart',
  // 'easeOutInQuint',
  // 'easeOutInSine',
  // 'easeOutQuad',
  // 'easeOutQuart',
  // 'easeOutQuint',
]
/*

 */
function randEasing(log) {
  const easing = aniEasings[anime.random(0, aniEasings.length)]
  if (log) console.log(easing)
  return easing || 'linear'
}

export default function aniItemsRandom(selector, callback, maxDuration = 700, maxDelay = 220, minDuration = 350) {
  const params = {
    targets: selector,
    opacity: {
      value: [0, 1],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(40, maxDelay)
    },
    fillOpacity: {
      value: [0, 1],
      duration: anime.random(minDuration + 200, maxDuration + 300),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(50, maxDelay)
    },
    translateY: {
      value: () => [anime.random(200, 50), 0],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(10, maxDelay)
    },
    translateX: {
      value: () => [anime.random(200, 50), 0],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(10, maxDelay)
    },
    translateZ: {
      value: () => [anime.random(200, 50), 0],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(10, maxDelay)
    },
    rotateZ: {
      value: () => [anime.random(10, 70), 0],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(10, maxDelay)
    },
    rotateX: {
      value: () => [anime.random(70, 30), 0],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(10, maxDelay)
    },
    rotateY: {
      value: () => [anime.random(10, 70), 0],
      duration: anime.random(minDuration, maxDuration),
      easing: randEasing(),
      delay: (el, index) => index * anime.random(10, maxDelay)
    },
    loop: false,
    complete: (a) => {
         // $(selector).addClass('animeted');
      if (callback) callback()
    }
  }

    // console.log('aniItemsRandom: '+selector, params);

  if (!$(selector).hasClass('animeted')) {
    $(selector).addClass('animeted')
    anime(params)
  } else {
     // console.log('Already animeted. Skipping');
  }
}
