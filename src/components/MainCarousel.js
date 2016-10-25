import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import { fetchSliderMain } from '../actions'

//import Carousel from './Carousel'

import Slider from 'react-slick'
import '../../less/css/slick.min.css'
import {prevIcon, nextIcon} from '../svg/controls'
import { addSrcSet } from '../etc'

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

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

export class MainCarousel extends Component {
  componentWillMount() {
      const { fetchSliderMain } = this.props;
      fetchSliderMain();
  }
  renderSlider(){
     if( !isEmpty(this.props.slider.main) ){

      var items = this.props.slider.main;

      var slides = items.map( (obj,key) => {
       // console.log('Slides', obj);
        //var srcSet = addSrcSet(obj);
        //console.log('src ', srcSet);
        return(
          <div key={key} className="food-carousel-item">
            <img src={obj.full}/>
            <div className="food-carousel-description">
              <div className="box">
                <b>{obj.title}</b>
                {/*<i>{obj.title}</i>*/}
              </div>
            </div>
          </div>
        )
      });

      return(
        <Slider {...sliderSettings} className="food-carousel">
          {slides}
        </Slider>
      )
    }
  }

  render(){

   // console.log('MainCarousel: ', this.props.slider, this.state);

    return(
      <div>
        {this.renderSlider()}
      </div>
    )
  }
}

function mapStateToProps(state) {
    const slider = state.slider;

    //console.log('mapStateToProps (slider): ', state, slider);

    return {
        slider: slider
    };
}

export default connect(
    mapStateToProps,
    { fetchSliderMain }
)(MainCarousel);
