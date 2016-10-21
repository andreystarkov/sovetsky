import React, { Component } from 'react'

import Slider from 'react-slick'
import Transition from 'react-motion-ui-pack'
import {Motion, spring} from 'react-motion'
import {prevIcon, nextIcon} from '../svg/controls'

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

    if( items ){
      var carousel = items.map( (obj,key) => {
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
          <Slider {...settings} key={1} initialSlide={first} className="fullscreen-carousel">
            {carousel}
          </Slider>
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
