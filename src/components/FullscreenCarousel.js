import React, { Component } from 'react'

import Slider from 'react-slick'
import Transition from 'react-motion-ui-pack'
import {Motion, spring} from 'react-motion'
import {prevIcon, nextIcon} from '../svg/controls'
import { addSrcSet } from '../etc'

import anime from 'animejs'

export default class FullscreenCarousel extends Component {
  closeCarousel(){

  }
  componentDidUpdate(){

    if( this.props.isOpen ){
      anime({
        targets: '.fullscreen-carousel',
        translateY: {
          value: [ -(window.innerHeight+400), 0],
          delay: 0,
          duration: 850,
          easing: 'easeInOutExpo'
        }
      }
      )
    }
  }
  render() {
    var settings = {
      dots: false,
      infinite: true,
      speed: 500,
      autoplay: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: prevIcon(),
      nextArrow: nextIcon()
    },
    items = this.props.items,
    first = this.props.first,
    isOpen = this.props.isOpen;

    //console.log('FSC: ', items);
    if( items ){
      var carousel = items.map( (obj,key) => {
        //var srcSet = addSrcSet(obj);
        //console.log('srcSet', obj, srcSet);
        return(
          <div key={key} className="food-carousel-item">
           <img src={obj.full} />
          </div>
        )
      });
    }

    function initCarousel(isOpen){
      if( isOpen ){
        return(
        <div className="fullscreen-carousel-container">
          <div className="turn-screen">
            <div className="icon-turn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 312.513 312.513">
              <circle cx="97.106" cy="210.198" r="8.35"/>
              <path d="M286.322 135.845H148.707V63.583c0-14.442-11.75-26.19-26.19-26.19H26.19C11.75 37.392 0 49.14 0 63.582V258.36c0 14.442 11.75 26.19 26.19 26.19h260.133c14.442 0 26.19-11.75 26.19-26.19v-96.324c0-14.442-11.75-26.19-26.19-26.19zm-159.754 18h134.66v112.707h-134.66V153.845zm-35.024-18c-14.442 0-26.19 11.75-26.19 26.19v61.302H18V88.677h112.707v47.167H91.544zM26.19 55.392h96.326c4.517 0 8.19 3.674 8.19 8.19v7.095H18v-7.094c0-4.517 3.674-8.19 8.19-8.19zM18 258.36v-17.023h47.353v17.023c0 2.86.468 5.612 1.32 8.19H26.19c-4.516.002-8.19-3.673-8.19-8.19zm65.353 0v-96.324c0-4.517 3.675-8.19 8.19-8.19h17.024V266.55H91.544c-4.516 0-8.19-3.675-8.19-8.192zm211.16 0c0 4.517-3.674 8.19-8.19 8.19h-7.095V153.846h7.094c4.517 0 8.19 3.675 8.19 8.19v96.325z"/>
              <path d="M193.506 79.835c1.464 1.464 3.384 2.197 5.303 2.197s3.838-.732 5.302-2.197c2.93-2.93 2.93-7.678 0-10.606l-5.774-5.775c14.772 3.285 26.48 14.78 30.072 29.436l-5.583-5.582c-2.928-2.93-7.677-2.93-10.606 0-2.928 2.93-2.928 7.678 0 10.606l19.538 19.538c1.406 1.407 3.314 2.197 5.303 2.197s3.898-.79 5.304-2.198l19.534-19.534c2.93-2.93 2.93-7.678 0-10.606-2.93-2.93-7.678-2.93-10.606 0L244 94.604c-3.454-24.236-22.793-43.41-47.106-46.618l7.222-7.222c2.93-2.93 2.93-7.678 0-10.606-2.93-2.93-7.678-2.93-10.606 0l-19.537 19.538c-1.407 1.407-2.197 3.314-2.197 5.303s.79 3.896 2.197 5.302l19.533 19.533z"/>
            </svg>
            </div>
            <b>Переверните экран</b>
          </div>
          <Slider {...settings} key={1} initialSlide={first} className="fullscreen-carousel">
            {carousel}
          </Slider>
          <div className="fullscreen-carousel-overlay">
          </div>
        </div>
        )
      }
    }

    return(
      <div>
        {initCarousel(isOpen)}
      </div>
     )
  }
}
