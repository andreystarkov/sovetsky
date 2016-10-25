import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'

import Footer from '../components/Footer'
import InteriorCarousel from '../components/InteriorCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'

import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import Gallery from '../components/Gallery'
import Waypoint from 'react-waypoint'

import aniItemsRandom from '../animation/aniItemsRandom'
//import drawPath from '../animation/drawPath'

import anime from 'animejs'
import $ from 'jquery'

function drawPath(selector, callback, options = {
      duration: 1500,
      loop: false,
      easing: 'linear'
    }){

    var el= document.querySelector(selector),
        rect = el.getBoundingClientRect(),
        fill = $(el).attr('fill');

    var totalLength = (2 * Math.PI * rect.width) + 100;
    console.log('drawPath: totalLength', totalLength);

    $(selector).css({
      'stroke': '#444',
      'stroke-opacity': '1',
     // 'fill': 'transparent',
      'stroke-dasharray': totalLength
    });

    anime({
      targets: selector,
      ...options,
      strokeDashoffset: {
        value: (e) => {
          return [ 2 * Math.PI * e.getBoundingClientRect().width+400, 0 ];
        },
        duration: 1500
      },
      strokeWidth: {
        value: [2, 0],
        duration: 1500,
        delay: 1300
      },
      fill: {
        value: (e) => {
          console.log( 'fill', $(e).attr('fill') );
          return ['rgba(255,255,255,0)', $(e).attr('fill')]
        },
        delay: 500
      },
      opacity: [0, 1],
     // strokeDasharray: 0,
      strokeOpacity: 1,
      easing: 'easeInOutCubic',
      complete: (e) => {

        if(callback) callback();
      }
    });
}

class GalleryComposition extends Component {
  componentDidMount(){

    drawPath('.camera-circle-first');

/*    var selector = '.icon-camera circle';

    $(selector).css({
      stroke: '#111',
      strokeWidth: '3px',
      strokeDasharray: '1000px',
      strokeDashoffest: '1000px',
      fillOpacity: 0
    });

    anime({
      targets: selector,
      strokeDashoffset: (current) => {
        var length = '2000px'; //$(current)[0].getTotalLength() ||
        console.log('dash: ', length);
        return [length, 0]
      },
      duration: 1500
    });*/
    drawPath('.icon-camera circle');

    aniItemsRandom('.icon-camera circle', () => {
    });

    setTimeout(() => {
      aniItemsRandom('.icon-camera path');
    },500);

  }
  render(){
    return(
      <div className="icon-camera">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path fill="#959CB3" d="M291.31 87.175h-70.62V70.62c0-4.874 3.953-8.827 8.828-8.827h52.966c4.875 0 8.828 3.953 8.828 8.828v16.555z"/>
          <path fill="#AFB9D2" d="M150.07 158.897H79.447v-26.483c0-4.875 3.953-8.828 8.828-8.828h52.966c4.875 0 8.828 3.953 8.828 8.828v26.483z"/>
          <g fill="#C7CFE2">
            <path d="M61.793 158.9h-35.31V141.24c0-4.875 3.953-8.828 8.828-8.828h17.656c4.875 0 8.828 3.953 8.828 8.828V158.9zM467.862 160.002H406.07v-27.588c0-4.875 3.952-8.828 8.827-8.828h44.138c4.875 0 8.828 3.953 8.828 8.828v27.588z"/>
          </g>
          <path fill="#E4EAF6" d="M503.172 450.207H8.828c-4.875 0-8.828-3.953-8.828-8.828V158.896c0-4.875 3.953-8.828 8.828-8.828h494.345c4.875 0 8.828 3.952 8.828 8.827V441.38c0 4.874-3.953 8.827-8.828 8.827z"/>
          <path fill="#e55648" d="M0 238.345h512v185.38H0z"/>
          <path fill="#bd4034" d="M0 238.345h512v35.31H0z"/>
          <path fill="#E4EAF6" d="M167.724 132.414L206.568 85.8c3.354-4.024 8.323-6.352 13.564-6.352h71.737c5.238 0 10.208 2.327 13.563 6.353l38.844 46.614H167.724z"/>
          <path fill="#D7DEED" d="M512 158.897c0-4.875-3.953-8.828-8.828-8.828H346.924l-2.648-17.656H167.724l-2.648 17.655H8.828C3.953 150.07 0 154.02 0 158.896v8.828h162.428l-17.266 115.102c-2.595 17.304-2.274 34.92.95 52.12l17.56 93.66c2.35 12.524 13.287 21.6 26.03 21.6h132.595c12.744 0 23.68-9.076 26.03-21.6l17.56-93.66c3.224-17.2 3.545-34.816.95-52.12L349.57 167.725H512v-8.828z"/>
          <circle className="camera-circle-first" cx="256" cy="308.966" r="114.759" fill="#5B5D6E"/>
          <circle cx="256" cy="308.966" r="88.276" fill="#464655"/>
          <circle cx="256" cy="308.966" r="44.138" fill="#5B5D6E"/>
          <path fill="#464655" d="M256 291.31c-9.737 0-17.655 7.918-17.655 17.655S246.263 326.62 256 326.62c9.737 0 17.655-7.918 17.655-17.655S265.737 291.31 256 291.31z"/>
          <path fill="#D7DEED" d="M295.724 247.172c-12.17 0-22.07 9.898-22.07 22.07 0 12.17 9.9 22.068 22.07 22.068s22.07-9.898 22.07-22.07c0-12.17-9.9-22.068-22.07-22.068z"/>
          <g fill="#FFF">
            <path d="M264.828 286.897c-7.303 0-13.24 5.94-13.24 13.24 0 7.304 5.938 13.242 13.24 13.242s13.24-5.94 13.24-13.242c0-7.303-5.938-13.24-13.24-13.24zM296.375 291.244c-4.445-10.106-12.548-18.21-22.655-22.655-.007.22-.066.427-.066.65 0 12.17 9.898 22.07 22.07 22.07.223 0 .43-.06.65-.066z"/>
            <circle cx="105.931" cy="238.345" r="17.655"/>
          </g>
        </svg>
      </div>
    )
  }
}

class GalleryHeader extends Component {
  _handleWaypointEnter(){


  }
  _handleWaypointLeave(){

  }
  render(){
    return (
      <div style={{marginTop: '10rem'}}>
      <section className="decorative-menu-section main-food-text">

      <div className="container">
        <div className="row">
          <div className="col-md-4 col-xs-12">
            <GalleryComposition />
          </div>
          <div className="col-md-8 col-xs-12">
            <div className="decorative-section-content">
              <h2>Избранные моменты</h2>
              <p>Ниже вы можете просмотреть фотографии с мероприятий и событий в нашем ресторане. Наслаждайтесь!</p>
            </div>
          </div>
        </div>
      </div>
      <Waypoint
        onEnter={this._handleWaypointEnter}
        onLeave={this._handleWaypointLeave}
      />
    </section>
    </div>
    )
  }
}




export default class GalleryPage extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isOpen: false
    };
  }
  render() {
      return (
      <div>
        <GalleryHeader />
        <Gallery />
      </div>
      );
  }
}

