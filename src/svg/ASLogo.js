import React from 'react';
import anime from 'animejs'
import initAniEffects from '../animation/initAniEffects'
import aniEffects from '../animation/aniEffects'

function fadeIn(el) {
  el.style.opacity = 0;

  var last = +new Date();
  var tick = function() {
    el.style.opacity = +el.style.opacity + (new Date() - last) / 400;
    last = +new Date();

    if (+el.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
    }
  };

  tick();
}

class ASLogo extends React.Component {
  componentWillMount(){

  }
  componentDidMount(){


  }
  render(){
    return(
    <div className="content content--1 as-logo-container">

        <svg className="as-logo letters--effect-2 letters _transparent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.314 299.315">

          <circle id="as-circle" cx="150" className="the-circle" cy="150" r="148" fill="#fff"  fillRule="evenodd" />

          <g className="letter letter--1">
            <g className="letter__part">
               <path fill="#c83737" className="path-top-angle" fillRule="evenodd" d="M221.178 18.176c28.813 15.71 51.887 40.615 65.292 70.767h-30.777c-.242-22.71-6.34-41.342-18.3-55.9-4.6-5.667-10.006-10.623-16.215-14.867z"/>
            </g>
          </g>

          <g className="letter letter--2">
            <g className="letter__part">
              <path fill="#a02c2c" className="path-top-fill" fillRule="evenodd" d="M297.11 123.99c1.445 8.34 2.204 16.918 2.204 25.672 0 44.157-19.14 83.848-49.565 111.243l.14-.127c9.18-12.847 13.77-28.526 13.77-47.037 0-21.49-6.24-38.87-18.71-52.14-10.88-11.41-26.27-19.5-46.17-24.27l-81.59-18.71c-10.09-2.39-17.91-5.97-23.49-10.74-6.9-5.84-10.35-14.33-10.35-25.47 0-19.1 7.83-32.9 23.48-41.39 10.88-5.83 24.81-8.75 41.79-8.75 19.1 0 35.02 4.25 47.76 12.74 15.02 9.85 22.71 24.5 23.07 43.96h-.04V124h77.69z"/>
            </g>
          </g>

          <g className="letter letter--3">
            <g className="letter__part">
              <path fill="#214478" className="path-bottom-fill" fillRule="evenodd" d="M.868 165.786C.3 160.488 0 155.11 0 149.662 0 92.144 32.472 42.202 80.072 17.15c-3.947 2.837-7.628 6.013-11.04 9.525C53.642 42.595 45.95 62.893 45.95 87.57c0 21.758 7.828 38.74 23.483 50.946 9.288 7.165 21.76 12.604 37.414 16.32l58.51 13.4c23.88 5.57 40 11.74 48.358 18.573 8.358 6.76 12.537 17.44 12.537 32.03 0 14.33-5.573 25.67-16.718 33.9-13.002 9.55-32.372 14.33-58.11 14.33-22.023 0-39.802-4.65-53.333-13.93-16.98-11.68-25.47-29.32-25.47-52.94h-.08v-34.42H.87z"/>
            </g>
          </g>

          <g className="letter letter--4">
            <g className="letter__part">
              <path fill="#373e48" className="path-bottom-angle" fillRule="evenodd" d="M68.902 275.672C41.54 258.1 20.276 231.86 8.984 200.832h27.414c.057 14.606 2.112 27.666 6.167 39.178 4.113 11.675 11.74 22.554 22.886 32.637 1.15 1.043 2.3 2.05 3.46 3.025z"/>
            </g>
          </g>

        </svg>

    </div>
    )
  }
}

export default ASLogo
