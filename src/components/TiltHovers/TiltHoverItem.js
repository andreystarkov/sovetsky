import React, {PropTypes} from 'react'
import anime from 'animejs'
import imagesLoaded from 'imagesloaded'
import TiltFx from './TiltEngine'

import './TiltHovers.css'

window.TiltFx = TiltFx

export default class TiltHoverItem extends React.Component {
  componentDidMount() {
    this.initTilts()
  }
  initTilts() {
    var tiltSettings = [
    {},
    {
      movement: {
        imgWrapper : {
          translation : {x: 10, y: 10, z: 30},
          rotation : {x: 0, y: -10, z: 0},
          reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
        },
        lines : {
          translation : {x: 10, y: 10, z: [0,70]},
          rotation : {x: 0, y: 0, z: -2},
          reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
        },
        caption : {
          rotation : {x: 0, y: 0, z: 2},
          reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
        },
        overlay : {
          translation : {x: 10, y: -10, z: 0},
          rotation : {x: 0, y: 0, z: 2},
          reverseAnimation : {duration : 2000, easing : 'easeOutExpo'}
        },
        shine : {
          translation : {x: 100, y: 100, z: 0},
          reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
        }
      }
    },
    {
      movement: {
        imgWrapper : {
          rotation : {x: -5, y: 10, z: 0},
          reverseAnimation : {duration : 900, easing : 'easeOutCubic'}
        },
        caption : {
          translation : {x: 30, y: 30, z: [0,40]},
          rotation : {x: [0,15], y: 0, z: 0},
          reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
        },
        overlay : {
          translation : {x: 10, y: 10, z: [0,20]},
          reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
        },
        shine : {
          translation : {x: 100, y: 100, z: 0},
          reverseAnimation : {duration : 900, easing : 'easeOutCubic'}
        }
      }
    },
    {
      movement: {
        imgWrapper : {
          rotation : {x: -5, y: 10, z: 0},
          reverseAnimation : {duration : 50, easing : 'easeOutQuad'}
        },
        caption : {
          translation : {x: 20, y: 20, z: 0},
          reverseAnimation : {duration : 200, easing : 'easeOutQuad'}
        },
        overlay : {
          translation : {x: 5, y: -5, z: 0},
          rotation : {x: 0, y: 0, z: 6},
          reverseAnimation : {duration : 1000, easing : 'easeOutQuad'}
        },
        shine : {
          translation : {x: 50, y: 50, z: 0},
          reverseAnimation : {duration : 50, easing : 'easeOutQuad'}
        }
      }
    },
    {
      movement: {
        imgWrapper : {
          translation : {x: 0, y: -8, z: 0},
          rotation : {x: 3, y: 3, z: 0},
          reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
        },
        lines : {
          translation : {x: 15, y: 15, z: [0,15]},
          reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
        },
        overlay : {
          translation : {x: 0, y: 8, z: 0},
          reverseAnimation : {duration : 600, easing : 'easeOutExpo'}
        },
        caption : {
          translation : {x: 10, y: -15, z: 0},
          reverseAnimation : {duration : 900, easing : 'easeOutExpo'}
        },
        shine : {
          translation : {x: 50, y: 50, z: 0},
          reverseAnimation : {duration : 1200, easing : 'easeOutExpo'}
        }
      }
    },
    {
      movement: {
        lines : {
          translation : {x: -5, y: 5, z: 0},
          reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
        },
        caption : {
          translation : {x: 15, y: 15, z: 0},
          rotation : {x: 0, y: 0, z: 3},
          reverseAnimation : {duration : 1500, easing : 'easeOutElastic', elasticity : 700}
        },
        overlay : {
          translation : {x: 15, y: -15, z: 0},
          reverseAnimation : {duration : 500,easing : 'easeOutExpo'}
        },
        shine : {
          translation : {x: 50, y: 50, z: 0},
          reverseAnimation : {duration : 500, easing : 'easeOutExpo'}
        }
      }
    },
    {
      movement: {
        imgWrapper : {
          translation : {x: 5, y: 5, z: 0},
          reverseAnimation : {duration : 800, easing : 'easeOutQuart'}
        },
        caption : {
          translation : {x: 10, y: 10, z: [0,50]},
          reverseAnimation : {duration : 1000, easing : 'easeOutQuart'}
        },
        shine : {
          translation : {x: 50, y: 50, z: 0},
          reverseAnimation : {duration : 800, easing : 'easeOutQuart'}
        }
      }
    },
    {
      movement: {
        lines : {
          translation : {x: 40, y: 40, z: 0},
          reverseAnimation : {duration : 1500, easing : 'easeOutElastic'}
        },
        caption : {
          translation : {x: 20, y: 20, z: 0},
          rotation : {x: 0, y: 0, z: -5},
          reverseAnimation : {duration : 1000, easing : 'easeOutExpo'}
        },
        overlay : {
          translation : {x: -30, y: -30, z: 0},
          rotation : {x: 0, y: 0, z: 3},
          reverseAnimation : {duration : 750, easing : 'easeOutExpo'}
        },
        shine : {
          translation : {x: 100, y: 100, z: 0},
          reverseAnimation : {duration : 750, easing : 'easeOutExpo'}
        }
      }
    }];

    function init() {
      var idx = 0;
      [].slice.call(document.querySelectorAll('div.tilter')).forEach(function(el, pos) {
        idx = pos%2 === 0 ? idx+1 : idx;
        new TiltFx(el, tiltSettings[idx-1]);
      });
    }

    // Preload all images.
    imagesLoaded(document.querySelector('main'), function() {
      document.body.classList.remove('loading');
      init();
    });

    var pater = document.querySelector('.pater'),
      paterSVG = pater.querySelector('.pater__svg'),
      pathEl = paterSVG.querySelector('path'),
      paths = {default: pathEl.getAttribute('d'), active: paterSVG.getAttribute('data-path-hover')};

    pater.addEventListener('mouseenter', function() {
      anime.remove(pathEl);
      anime({
        targets: pathEl,
        d: paths.active,
        duration: 400,
        easing: 'easeOutQuad'
      });
    });

    pater.addEventListener('mouseleave', function() {
      anime.remove(pathEl);
      anime({
        targets: pathEl,
        d: paths.default,
        duration: 400,
        easing: 'easeOutExpo'
      });
    });
  }
  handleClick() {
    if(this.props.onClick) this.props.onClick(this.props.data || false);
  }
  render() {
    return (
      <div onClick={this.handleClick.bind(this)} className={`tilter tilter--${this.props.filter || '1'}${this.props.className || ''}`}>
        <figure className="tilter__figure">
          <img className="tilter__image" src={this.props.src} alt={this.props.alt || '...'} />
          <div className="tilter__deco tilter__deco--shine"><div></div></div>
          <figcaption className="tilter__caption">
            <h3 className="tilter__title">{this.props.title || ''}</h3>
            <p className="tilter__description">{this.props.description || ''}</p>
          </figcaption>
          <svg className="tilter__deco tilter__deco--lines" viewBox="0 0 300 415">
            <path d="M20.5,20.5h260v375h-260V20.5z" />
          </svg>
        </figure>
      </div>
    );
  }
}
