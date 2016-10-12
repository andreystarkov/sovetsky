import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import {fetchSliderMain} from '../actions'
import Slider from 'react-slick'
import '../../less/css/slick.min.css'
import {prevIcon, nextIcon} from '../svg/controls'

var sliderSettings = {
  dots: false,
  infinite: true,
  speed: 500,
  autoplay: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  prevArrow: prevIcon(),
  nextArrow: nextIcon()
};

export default class Carousel extends Component {
    render() {
      console.log('Carousel: ', this.props.items);
        return (
          <Slider {...sliderSettings} className="food-carousel">
              <div className="food-carousel-item">
                <img src="/resources/images/samples/1.jpg" />
                <div className="food-carousel-description">
                  <div className="box">
                    <b>Чудеснейшее блюдо</b>
                    <span>180 р.</span>
                  </div>
                </div>
              </div>
              <div className="food-carousel-item">
                <img src="/resources/images/samples/2.jpg" />
                <div className="food-carousel-description">
                  <div className="box">
                    <b>Чудеснейsasa юдо</b>
                    <span>180 р.</span>
                  </div>
                </div>
              </div>
              <div className="food-carousel-item">
                <img src="/resources/images/samples/3.jpg" />
                <div className="food-carousel-description">
                  <div className="box">
                    <b>Чудеснfdsfейшее блюдо</b>
                    <span>180 р.</span>
                  </div>
                </div>
              </div>
          </Slider>
        );
    }
}
