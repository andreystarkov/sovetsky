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
import { api, WP_URL } from '../config'
import drawPath from '../animation/drawPath'
import aniItemsRandom from '../animation/aniItemsRandom'

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

export function drawStar(){
  drawPath('.ussr-path-center', () => {

  }, {
      duration: 1600,
      loop: false,
      easing: 'easeInOutQuint'
  });

  setTimeout( () => {
    anime({
      targets: '.ussr-path-center',
      fill: '#fff',
      strokeOpacity:0,
      duration:2300
    });
  }, 1400);

  setTimeout( () => {
      anime({
        targets: '.ussr-path',
        fill: '#e12210',
        strokeOpacity:0,
        duration:2300
      });
  }, 1800);


}

class MainHeader extends Component {
  componentDidMount(){
    if (window.isLoaded) drawStar();
  }
  render() {
    return(
      <section className="main-header">
        <div className="top-header-overlay"></div>
        <Slider {...sliderSettings} className="food-carousel interior-carousel">
          <div>
            <Parallax bgImage={WP_URL+'/wp-content/uploads/2016/10/M26A0020.jpg'} strength={300} />
          </div>
          <div>
            <Parallax bgImage={WP_URL+'/wp-content/uploads/2016/10/M26A0027.jpg'} strength={300} />
          </div>
          <div>
            <Parallax bgImage={WP_URL+'/wp-content/uploads/2016/10/2-1.jpg'} strength={300} />
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

class FoodComposition extends Component {
  render(){
    return(
    <div className="ani-composition">
       <div className="ani-icon icon-soup">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500.8 500.8">
            <path className="plate" fill="#FCF7C5" d="M499.2 235.08H0l77.6 180.8v.8c0 23.2 76.8 41.6 170.4 41.6 94.4 0 171.2-18.4 171.2-41.6v-1.6l80-180z"/>
            <path className="plate" fill="#EFE5AB" d="M250.4 457.48c94.4 0 169.6-18.4 169.6-40.8 0 0-.8-.8-.8-1.6l81.6-180H1.6"/>
            <ellipse className="plate" cx="250.4" cy="235.08" fill="#E2D998" rx="250.4" ry="60.8"/>
            <path fill="#C6B96D" className="plate" d="M250.4 174.28c138.4 0 250.4 27.2 250.4 60.8s-112 60.8-250.4 60.8"/>
            <path className="surface" fill="rgb(225, 34, 16)" d="M250.4 207.08c-114.4 0-207.2 22.4-207.2 49.6 0 5.6 3.2 10.4 9.6 15.2 45.6 14.4 116.8 23.2 197.6 23.2s151.2-8.8 197.6-23.2c6.4-4.8 9.6-9.6 9.6-15.2 0-27.2-92.8-49.6-207.2-49.6z"/>
            <path className="surface" fill="rgb(225, 34, 16)" d="M250.4 295.08c80 0 151.2-8.8 197.6-23.2 6.4-4.8 9.6-9.6 9.6-15.2 0-28-92.8-49.6-207.2-49.6"/>
            <ellipse className="surface" cx="333.6" cy="247.08" fill="rgb(241, 59, 42)" rx="56" ry="11.2"/>
            <path className="spoon" fill="#00233F" d="M352 243.08c4.8-16 9.6-32 15.2-49.6 32.8-100 65.6-139.2 32.8-149.6s-29.6 39.2-62.4 139.2c-7.2 21.6-14.4 43.2-21.6 59.2h36v.8z"/>
            <path className="surface" fill="rgb(225, 34, 16)" d="M136.8 215.08c-35.2 5.6-62.4 13.6-78.4 23.2L44 252.68c-.8 1.6-.8 3.2-.8 4.8 0 5.6 3.2 10.4 9.6 15.2 39.2 12 96.8 20.8 163.2 22.4l-79.2-80z"/>
            <path className="leaves" fill="#357503" d="M116.8 267.08c26.4 0 51.2-29.6 52-55.2.8-44.8-39.2-59.2-55.2-96.8"/>
            <path className="leaves" fill="#5EA304" d="M119.2 263.08v.8l-.8.8c-28-16-51.2-31.2-53.6-56.8-4.8-44.8 32.8-56 48.8-92.8"/>
            <path className="leaves" fill="#357503" d="M118.4 265.48c8-24 13.6-49.6-2.4-66.4-28-29.6-60-9.6-95.2-23.2"/>
            <path className="leaves" fill="#5EA304" d="M118.4 265.48c-28.8 8-53.6 13.6-72-1.6-32-26.4-11.2-56-26.4-88.8"/>
          </svg>
      </div>

      <div className="ani-icon icon-brew">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 496">
            <path fill="#F2E197" d="M389.105 144v-1.6c-8-13.6-21.6-23.2-38.4-24l-44-26.4c-1.6-2.4-2.4-4-10.4-4.8V40h-96v47.2c-8 0-8.8 1.6-11.2 4.8l-43.2 26.4c-16 .8-30.4 11.2-38.4 24.8l-.8.8c-4 8-3.2 13.6-3.2 22.4v283.2c0 26.4 17.6 46.4 44 46.4h199.2c26.4 0 44-20 44-46.4V166.4c1.6-8.8 3.2-14.4-1.6-22.4z"/>
            <path fill="#DBC772" d="M348.305 496c26.4 0 44-20 44-46.4V166.4c0-8.8 1.6-15.2-3.2-23.2-8-13.6-21.6-23.2-38.4-24l-44-26.4c-1.6-3.2-2.4-4.8-10.4-5.6V40h-96v47.2c-8 0-8.8 1.6-11.2 4.8l-44 26.4"/>
            <path fill="#C1AD56" d="M392.305 168c0-8.8.8-17.6-3.2-25.6-8-13.6-21.6-23.2-38.4-24l-44-26.4c-1.6-2.4-2.4-4-10.4-4.8V40h-96v47.2c-8 0-8.8 1.6-11.2 4.8l-43.2 27.2"/>
            <path fill="#190D0D" d="M200.305 40h96v48h-96z"/>
            <path fill="#C46A27" d="M104.305 232v217.6c0 26.4 17.6 46.4 44 46.4h199.2c26.4 0 44-20 44-46.4V232h-287.2z"/>
            <path fill="#A54C11" d="M348.305 496c26.4 0 44-20 44-46.4V232h-288"/>
            <path fill="#D63834" d="M152.305 192h192v216h-192z"/>
            <path fill="#3D2525" d="M304.305 38.4c0 5.6-4 9.6-14.4 9.6h-83.2c-10.4 0-14.4-4-14.4-9.6V9.6c0-6.4 4-9.6 14.4-9.6h84c9.6 0 13.6 3.2 13.6 9.6v28.8z"/>
            <path fill="#EF922E" d="M392.305 228c0 2.4-1.6 4-4 4h-280c-2.4 0-4-1.6-4-4s1.6-4 4-4h280c2.4 0 4 1.6 4 4z"/>
            <path fill="#3D2525" d="M152.305 192h192v216h-192z"/>
            <path fill="#190D0D" d="M152.305 192h192v216"/>
            <path fill="#3D2525" d="M152.305 424h192v24h-192z"/>
            <path fill="#190D0D" d="M152.305 424h192v24"/>
            <path fill="#EF9C62" d="M128.305 435.2c0 3.2-.8 5.6-4 5.6s-4-2.4-4-5.6V256c0-3.2.8-5.6 4-5.6s4 2.4 4 5.6v179.2z"/>
            <path fill="#fff" d="M128.305 216.8c0 .8-.8 1.6-4 1.6s-4-.8-4-1.6v-65.6c0-.8.8-1.6 4-1.6s4 .8 4 1.6v65.6z"/>
            <circle cx="248.305" cy="202.4" r="44" fill="#190D0D"/>
            <path fill="#A54C11" d="M192.305 32h112v8h-112z"/>
            <path fill="#F2E197" d="M248.305 187.2l4.8 10.4 12 1.6-8.8 8 2.4 11.2-10.4-5.6-10.4 5.6 2.4-11.2-8.8-8 12-1.6z"/>
            <path fill="#DBC772" d="M248.305 187.2l4.8 10.4 12 1.6-8.8 8 2.4 11.2-10.4-5.6"/>
            <g fill="#E8D480">
              <circle cx="181.905" cy="212.8" r="4"/>
              <circle cx="199.505" cy="212.8" r="4"/>
              <circle cx="297.105" cy="212.8" r="4"/>
              <circle cx="314.705" cy="212.8" r="4"/>
              <circle cx="181.905" cy="385.6" r="4"/>
              <circle cx="199.505" cy="385.6" r="4"/>
              <circle cx="297.105" cy="385.6" r="4"/>
              <circle cx="314.705" cy="385.6" r="4"/>
            </g>
            <path fill="#6D4747" d="M296.305 12c0 1.6-1.6 4-4 4h-88c-2.4 0-4-2.4-4-4s1.6-4 4-4h88.8c1.6 0 3.2 2.4 3.2 4z"/>
            <path fill="#DBC772" className="icon-brew-sssr" d="M192.305 269.6l56-31.2 56 31.2v61.6l-56 31.2-56-31.2z"/>
            <path fill="#C1AD56" d="M248.305 238.4l56 31.2v61.6l-56 31.2"/>
            <path d="M240.444 253.55c29.438 10.89 54.07 37.877 33.56 67.12l6.87 6.476c1.962 1.962-4.22 8.242-6.183 6.182l-7.163-7.458c-9.91 5.103-23.943 2.65-37.877-11.187l-.785.98.392.296c3.238 2.354-.49 6.573-3.336 4.513-2.55-.393-1.57 11.48-7.555 13.247-3.63.49-5.594-.883-5.79-4.318-.49-5.79 11.48-8.83 9.91-11.383-3.237-2.356.05-6.87 3.24-4.514l.49.294 3.042-4.12c12.364 8.34 22.177 9.713 29.635 7.456l-28.85-29.93-7.948 7.753-9.617-9.814 14.916-14.62 9.813.097 4.808 4.808-7.654 7.557 31.597 29.832c19.724-24.73-11.873-49.262-25.513-59.468z"/>
          </svg>
      </div>

      <div className="ani-icon icon-tomato">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 494.4 494.4">
          <path fill="#C92B00" d="M494.4 268.4c0 124-110.4 204-247.2 204S0 392.4 0 268.4 110.4 95.6 247.2 95.6s247.2 48.8 247.2 172.8z"/>
          <path fill="#A01C02" d="M247.2 95.6c136.8 0 247.2 48 247.2 172.8 0 124-110.4 204-247.2 204"/>
          <g fill="#EF4220">
            <ellipse cx="100.899" cy="174.789" transform="rotate(-119.8 100.86 174.763)" rx="25.6" ry="68.801"/>
            <ellipse cx="38.318" cy="252.518" transform="rotate(-119.8 38.3 252.477)" rx="16" ry="15.2"/>
          </g>
          <ellipse cx="247.2" cy="105.2" fill="#5EA304" rx="105.6" ry="30.4"/>
          <ellipse cx="247.2" cy="96.4" fill="#388C02" rx="93.6" ry="21.6"/>
          <path fill="#5EA304" d="M204 133.2l43.2 44 44-44z"/>
          <path fill="#388C02" d="M240.8 134.8l6.4 42.4 42.4-42.4z"/>
          <path fill="#5EA304" d="M142.4 108.4l22.4 45.6 44.8-23.2z"/>
          <path fill="#388C02" d="M171.2 118l-6.4 36 44.8-23.2zm180-8.8L329.6 154l-44.8-23.2z"/>
          <path fill="#5EA304" d="M323.2 118l6.4 36-44.8-23.2z"/>
          <path fill="#388C02" d="M266.4 86.8H228l8-61.6h22.4z"/>
          <path fill="#036D2E" d="M239.2 22.8l19.2 2.4 10.4 61.6"/>
          <g fill="#5EA304">
            <ellipse cx="247.2" cy="25.2" rx="11.2" ry="3.2"/>
            <ellipse cx="196.047" cy="89.964" transform="rotate(-98.8 196.043 90)" rx="6.4" ry="23.199"/>
          </g>
        </svg>
      </div>

      <div className="ani-icon icon-bread">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 486.4 486.4">
          <path fill="#AD6B1A" d="M451.2 202.8c24-23.2 35.2-53.6 35.2-87.2 0-74.4-61.6-96.8-139.2-96.8-41.6 0-78.4 6.4-104 24-25.6-17.6-63.2-24-104.8-24C60.8 19.6 0 41.2 0 115.6c0 33.6 11.2 64 35.2 87.2v190.4c0 48.8-25.6 89.6 23.2 89.6h370.4c48.8 0 23.2-40.8 23.2-89.6V202.8h-.8z"/>
          <path fill="#E5A641" d="M451.2 187.6c24-23.2 35.2-53.6 35.2-87.2 0-74.4-61.6-96.8-139.2-96.8-41.6 0-78.4 6.4-104 24-25.6-17.6-63.2-24-104.8-24C60.8 4.4 0 26 0 100.4c0 33.6 11.2 64 35.2 87.2V378c0 48.8-25.6 88.8 23.2 88.8h370.4c48.8 0 23.2-40 23.2-88.8V187.6h-.8z"/>
          <path fill="#C47E22" d="M428 466.8c48.8 0 23.2-40 23.2-88.8V187.6c24-23.2 35.2-53.6 35.2-87.2 0-74.4-61.6-96.8-139.2-96.8-41.6 0-78.4 6.4-104 24-25.6-17.6-64-24-105.6-24"/>
          <path fill="#F2E5A2" d="M419.2 194c16-19.2 25.6-44 25.6-71.2 0-60.8-52-78.4-115.2-78.4-33.6 0-64.8 5.6-85.6 19.2-20.8-14.4-51.2-19.2-85.6-19.2-63.2 0-116.8 17.6-116.8 78.4 0 27.2 9.6 52 25.6 71.2v155.2c0 40-14.4 85.6 24.8 85.6h301.6c40 0 24.8-46.4 24.8-85.6V194h.8z"/>
          <g fill="#E2CE8D">
            <path d="M394.4 434.8c40 0 24.8-46.4 24.8-85.6V194c16-19.2 25.6-44 25.6-71.2 0-60.8-52-78.4-115.2-78.4-33.6 0-64.8 5.6-85.6 19.2-20.8-14.4-50.4-19.2-84.8-19.2"/>
            <circle cx="147.2" cy="160.4" r="20"/>
            <circle cx="248" cy="380.4" r="20"/>
          </g>
          <circle cx="379.2" cy="123.6" r="20" fill="#F2E5A2"/>
          <g fill="#E2CE8D">
            <circle cx="139.2" cy="335.6" r="12.8"/>
            <circle cx="123.2" cy="235.6" r="10.4"/>
            <circle cx="196" cy="286" r="10.4"/>
          </g>
          <circle cx="323.2" cy="230.8" r="10.4" fill="#F2E5A2"/>
          <g fill="#E2CE8D">
            <circle cx="103.2" cy="107.6" r="8"/>
            <circle cx="188" cy="210" r="8"/>
          </g>
          <circle cx="304.8" cy="138" r="8" fill="#F2E5A2"/>
          <circle cx="257.6" cy="279.6" r="4.8" fill="#E2CE8D"/>
          <circle cx="367.2" cy="274" r="4.8" fill="#F2E5A2"/>
        </svg>
      </div>
    </div>
    )
  }
}

var isAnimating = false;

class DecorativeMenuSection extends Component {
  _handleWaypointEnter(){

    aniItemsRandom('.icon-soup .plate, .icon-soup .surface', () => {
      aniItemsRandom('.icon-soup .spoon, .icon-soup .leaves');
    });

    setTimeout( () => {
      aniItemsRandom('.icon-brew path, .icon-brew ellipse, .icon-brew circle');
    }, 800)

    setTimeout(() => {
      aniItemsRandom('.icon-bread path, .icon-bread ellipse, .icon-bread circle');
    },1200);
    setTimeout(() => {
      aniItemsRandom('.icon-tomato path, .icon-tomato ellipse, icon-tomato circle');
    },500);

  }
  _handleWaypointLeave(){

  }
  render(){
    return (
      <section className="decorative-menu-section main-food-text">
      <div className="container">
        <div className="row">
          <div className="col-md-5 col-xs-12 icon-composition-container">
              <FoodComposition />
          </div>
          <div className="col-md-7 col-xs-12">
            <div className="decorative-section-content">
              <h2>Доставка блюд</h2>
              <p>Для настящих ценителей качественной советской кухни мы осуществляем доставку блюд на дом. Для заказа передйте в соответствующий раздел.</p>

              <a className="button-more button-square-red" href="/delivery">Посмотреть меню</a>
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
                <section className="index-carousel" data-index-section-name="index-carousel">
                <MainCarousel />
                </section>
                <section className="standart-scroll" data-index-section-name="index-contacts">
                <Contacts  />
                </section>

            </div>
        );
    }
}


