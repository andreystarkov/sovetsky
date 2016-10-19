import React, { Component } from 'react'
import Slider from 'react-slick'
import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'

import Footer from '../components/Footer'
import MainCarousel from '../components/MainCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
import { prevIcon, nextIcon } from '../svg/controls'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import $ from 'jquery'
import anime from 'animejs'
import _ from 'underscore'
import Waypoint from 'react-waypoint'

require('jquery-scrollify')

var sliderSettings = {
  dots: false,
  infinite: true,
  speed: 1500,
  autoplay: true,
  slidesToShow: 1,
  pauseOnHover: false,
  accessibility: false,
  arrows: false,
  autoplaySpeed: 5000,
  fade: true,
  slidesToScroll: 1,
  prevArrow: prevIcon(),
  nextArrow: nextIcon()
};

function drawPath(selector, callback, options = {
      duration: 1500,
      loop: false,
      easing: 'linear'
    }){

    var totalLength = $(selector)[0].getTotalLength();

    console.log('drawPath: ', selector, options);

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

/*    setTimeout(() => {
      if(callback) callback();
    },2000)*/
}

var ussrCenterStyles = {
  fill: 'transparent',
  stroke: '#111',
  strokeWidth: '2px',
  strokeOpacity: 0
};

var ussrStarStyles = {
  fill: 'transparent',
  stroke: '#111',
  strokeWidth: '2px',
  strokeOpacity: 0
};

class MainHeader extends Component {
  componentDidMount(){

    drawPath('.ussr-path-center', () => {
      anime({
        targets: '.ussr-path-center',
        fill: '#fff',
        strokeOpacity:0,
        duration:3300
      });
      drawPath('.ussr-path', () => {
        anime({
          targets: '.ussr-path',
          fill: '#e12210',
          strokeOpacity:0,
          duration:3300
        });
      });

    });

  }
  render() {
    return(
      <section className="main-header">
        <div className="top-header-overlay">
{/*          <div className="main-header-container container">
            <div className="top-phones">
              <b className="phone"><span>(3532)</span> 55-00-55</b>
              <span className="address">г. Оренбург. ул. Просторная 21/1</span>
            </div>
            <MainLogo />
            <MainNavigation />
          </div>*/}
        </div>
        <Slider {...sliderSettings} className="food-carousel interior-carousel">
          <div>
            <Parallax bgImage="http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp-content/uploads/2016/10/M26A0020.jpg" strength={300} />
          </div>
          <div>
            <Parallax bgImage="http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp-content/uploads/2016/10/M26A0027.jpg" strength={300} />
          </div>
          <div>
            <Parallax bgImage="http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp-content/uploads/2016/10/2-1.jpg" strength={300} />
          </div>
        </Slider>

        <div className="header-logo-wrapper">
          <div className="header-logo">
            <svg className="ussr-star" style={{height: '100%'}} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 196.30287 186.63644">
              <path className="ussr-path" style={ussrStarStyles} d="M98.15 0l23.135 71.3h75.018l-60.643 44.036 23.134 71.3L98.15 142.6l-60.64 44.036 23.132-71.3L0 71.3h75.018"/>
              <path className="ussr-path-center" style={ussrCenterStyles} d="M93.69 69.4c24.786 9.17 45.523 31.89 28.256 56.51l5.783 5.454c1.65 1.653-3.554 6.94-5.206 5.205l-6.03-6.28c-8.346 4.296-20.16 2.23-31.892-9.418l-.66.826.33.248c2.726 1.983-.414 5.535-2.81 3.8-2.148-.33-1.322 9.667-6.36 11.154-3.058.413-4.71-.744-4.876-3.635-.413-4.875 9.667-7.436 8.345-9.584-2.726-1.982.042-5.783 2.727-3.8l.413.248 2.56-3.47c10.41 7.023 18.673 8.18 24.952 6.28l-24.29-25.2-6.692 6.527-8.096-8.262 12.558-12.31 8.262.083 4.048 4.048-6.444 6.362 26.603 25.116c16.607-20.82-9.996-41.475-21.48-50.067z"/>
            </svg>
          </div>
        </div>

        <div className="section-down-wrapper">
          <div className="arrow-down">
          <svg viewBox="0 0 32.634 32.634">
            <path d="M16.317,32.634c-0.276,0-0.5-0.224-0.5-0.5V0.5c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5v31.634   C16.817,32.41,16.593,32.634,16.317,32.634z" fill="#4e4e4e"/>
            <path d="M16.315,32.634L16.315,32.634c-0.133,0-0.26-0.053-0.354-0.146L3.428,19.951c-0.195-0.195-0.195-0.512,0-0.707   s0.512-0.195,0.707,0l12.179,12.183l12.184-12.183c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L16.668,32.487   C16.574,32.581,16.448,32.634,16.315,32.634z" fill="#4e4e4e"/>
          </svg>
          </div>
        </div>

      </section>
    )
  }
}


// style={{ backgroundImage: 'url(/resources/images/decorative/borsh.png)' }}

var styleSoup = {
  textAlign: 'center',
  marginTop: '2rem'
};

var styleSoupSvg = {
  width: '45%'
};

var sopts = {
  duration: 10000,
  loop: true
}

class DecorativeMenuSection extends Component {
  componentDidMount(){


  }
  _handleWaypointEnter(){
    var items = $('.soup-icon svg path:nth-child(1)');

    var totalLength = '1500px';

    var colors = [];

    $('.soup-icon svg path').each(function(){
      colors.push($(this).attr('fill'));
    });

    console.log(colors);

    $('.soup-icon svg path, .soup-icon svg ellipse').css({
        'fill-opacity': '0'
    });

    anime({
      targets: '.soup-icon svg .surface',
      fillOpacity: [0,1],
      duration: 600,
      translateY: {
        value: [-300, 0]
      },
      translateX: {
        value: [-300, 0]
      },
      rotate: {
        value: [90, 0]
      },
      loop: false,
      easing: 'linear',
      delay: function(el, index) {
        return index * 180;
      },
      complete: (a) => {
        anime({
          targets: '.soup-icon svg .leaves',
          duration: 300,
          fillOpacity: [0,1],
          scale: [0.3, 1],
          translateX: [-200,0],
          delay: function(el, index) {
            return index * 100;
          },
          rotate: {
            value: [20, 0]
          },
          loop: false,
          easing: 'linear'
        })
      }
    });

    anime({
      targets: '.soup-icon svg .plate',
      fillOpacity: [0,1],
      duration: 500,
      translateY: {
        value: [300, 0]
      },
      translateX: {
        value: [300, 0]
      },
      rotate: {
        value: [-90, 0]
      },
      loop: false,
      easing: 'linear',
      delay: function(el, index) {
        return index * 220;
      },
      complete: (a) => {
        anime({
          targets: '.soup-icon svg .spoon',
          duration: 400,
          fillOpacity: [0,1],
          scale: [0.3, 1],
          translateX: [600,0],
          rotate: {
            value: [15, 0]
          },
          loop: false,
          easing: 'linear'
        })
      }
    });
  }
  _handleWaypointLeave(){

  }
  render(){
    return (
      <section className="decorative-menu-section main-food-text">
      <div className="decorative-left" >
           <div className="soup-icon" style={styleSoup}>
              <svg style={styleSoupSvg} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500.8 500.8">
                <path className="plate" fill="#FCF7C5" d="M499.2 235.08H0l77.6 180.8v.8c0 23.2 76.8 41.6 170.4 41.6 94.4 0 171.2-18.4 171.2-41.6v-1.6l80-180z"/>
                <path className="plate" fill="#EFE5AB" d="M250.4 457.48c94.4 0 169.6-18.4 169.6-40.8 0 0-.8-.8-.8-1.6l81.6-180H1.6"/>
                <ellipse className="plate" cx="250.4" cy="235.08" fill="#E2D998" rx="250.4" ry="60.8"/>
                <path fill="#C6B96D" className="plate" d="M250.4 174.28c138.4 0 250.4 27.2 250.4 60.8s-112 60.8-250.4 60.8"/>
                <path className="surface" fill="#F47400" d="M250.4 207.08c-114.4 0-207.2 22.4-207.2 49.6 0 5.6 3.2 10.4 9.6 15.2 45.6 14.4 116.8 23.2 197.6 23.2s151.2-8.8 197.6-23.2c6.4-4.8 9.6-9.6 9.6-15.2 0-27.2-92.8-49.6-207.2-49.6z"/>
                <path className="surface" fill="#F25600" d="M250.4 295.08c80 0 151.2-8.8 197.6-23.2 6.4-4.8 9.6-9.6 9.6-15.2 0-28-92.8-49.6-207.2-49.6"/>
                <ellipse className="surface" cx="333.6" cy="247.08" fill="#FF8B00" rx="56" ry="11.2"/>
                <path className="spoon" fill="#00233F" d="M352 243.08c4.8-16 9.6-32 15.2-49.6 32.8-100 65.6-139.2 32.8-149.6s-29.6 39.2-62.4 139.2c-7.2 21.6-14.4 43.2-21.6 59.2h36v.8z"/>
                <path className="surface" fill="#F25600" d="M136.8 215.08c-35.2 5.6-62.4 13.6-78.4 23.2L44 252.68c-.8 1.6-.8 3.2-.8 4.8 0 5.6 3.2 10.4 9.6 15.2 39.2 12 96.8 20.8 163.2 22.4l-79.2-80z"/>
                <path className="leaves" fill="#357503" d="M116.8 267.08c26.4 0 51.2-29.6 52-55.2.8-44.8-39.2-59.2-55.2-96.8"/>
                <path className="leaves" fill="#5EA304" d="M119.2 263.08v.8l-.8.8c-28-16-51.2-31.2-53.6-56.8-4.8-44.8 32.8-56 48.8-92.8"/>
                <path className="leaves" fill="#357503" d="M118.4 265.48c8-24 13.6-49.6-2.4-66.4-28-29.6-60-9.6-95.2-23.2"/>
                <path className="leaves" fill="#5EA304" d="M118.4 265.48c-28.8 8-53.6 13.6-72-1.6-32-26.4-11.2-56-26.4-88.8"/>
              </svg>
          </div>
      </div>
      <div className="decorative-right"
           style={{ backgroundImage: 'url(/resources/images/decorative/carrot.png)' }} />
      <div className="container">
        <div className="row">
          <div className="col-md-4">
          </div>
          <div className="col-md-8">
            <div className="decorative-section-content">
              <h2>Только самое вкусные блюда</h2>
              <p>По мнению ученых, рентгеновская вспышка объясняется тем, что рядом с черной дырой прошла звезда, которая была разорвана приливными силами.</p>

              <button className="button-more button-square-red">Посмотреть меню</button>
            </div>
          </div>
        </div>
      </div>
      <Waypoint
        onEnter={this._handleWaypointEnter}
        onLeave={this._handleWaypointLeave}
      />
    </section>
    )
  }
}

export default class Root extends Component {
    componentDidMount(){

      console.log('ROOT', this.props);

/*      $.scrollify({
        section : ".index-scroll-section",
        sectionName : false,
      //  interstitialSection : "",
        easing: "easeOutExpo",
        scrollSpeed: 1100,
        offset : 0,
        scrollbars: true,
     //   standardScrollElements: "",
        setHeights: true,
        interstitialSection: '.standart-scroll',
        standardScrollElements: '.standart-scroll',
        overflowScroll: true,
        before:function() {},
        after:function() {},
        afterResize:function() {},
        afterRender:function() {}
      });*/

    }

    componenDidUpdate(){
    //  alert('a');
    }
    componentWillUnmount(){
    //  alert('didunmount')
    //  $.scrollify.disable();
    }

    render() {
        return (
            <div>
                <section id="index-top" className="section-header section-index-top index-scroll-section" data-index-section-name="index-top">
                  <MainHeader className="index-scroll-section" />
                </section>
                <section className="standart-scroll" data-index-section-name="index-interior">
                  <InteriorImages  />
                </section>
                <section className="standart-scroll" data-index-section-name="index-menu">
                  <DecorativeMenuSection />
                </section>
                <section className="standart-scroll" data-index-section-name="index-carousel">
                <MainCarousel />
                </section>
                <section className="standart-scroll" data-index-section-name="index-contacts">
                <Contacts  />
                </section>

            </div>
        );
    }
}


