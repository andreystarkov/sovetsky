import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import { fetchSliderInterior } from '../actions'
import MainLogo from '../svg/MainLogo'
import MainNavigation from '../components/MainNavigation'

//import Carousel from './Carousel'

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

function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
}

class InteriorHeader extends Component {
  render() {
    return(
      <section className="main-header interior-header">
          <div className="page-navigation">
            <MainLogo />
            <MainNavigation />
          </div>
      </section>
    )
  }
}


export class InteriorCarousel extends Component {
  componentWillMount() {
      const { fetchSliderInterior } = this.props;
      fetchSliderInterior();
  }
  renderSlider(){
     if( !isEmpty(this.props.slider.interior) ){

      console.log('renderSliderInterior: ', this.props.slider);
      var items = this.props.slider.interior;

      var slides = items.map( (obj,key) => {
        var styles;
        if ( !obj.title ) styles = {display: 'none'};
        return(
          <div key={key} className="food-carousel-item">
            <img src={obj.full} />
            <div className="food-carousel-description" style={styles}>
              <div className="box">
                <b>{obj.title}</b>
              </div>
            </div>
          </div>
        )
      });

      return(
      <div className="interior-slider-wrapper">
        <Slider {...sliderSettings} className="food-carousel interior-carousel">
          {slides}
        </Slider>
      </div>
      )
    }
  }

  render(){

  // console.log('InteriorCarousel2: ', this.props.slider, this.state);

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
    { fetchSliderInterior }
)(InteriorCarousel);
