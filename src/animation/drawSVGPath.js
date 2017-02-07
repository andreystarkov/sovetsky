import anime from 'animejs'
import $ from 'jquery'

export function drawSVGPath(selector, callback) {
  console.log(selector)
  $(selector).css({
    stroke: 'rgba(0,0,0,0.5)',
    'stroke-opacity': '1',
    'stroke-width': '3px',
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
      delay: (e, i) => i * anime.random(150, 350)
    },
    strokeWidth: {
      value: ['2px', '3px'],
      duration: 600,
      delay: (e, i) => i * anime.random(10, 450)
    },
    elasticity: anime.random(300, 500),
    duration: anime.random(400, 880),
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
      }, 500)

      //  if (callback) callback(e);
    }
  })
}

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
