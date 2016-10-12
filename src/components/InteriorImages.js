import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
// import * as LexiActions from '../actions'
import { Grid, Row, Col } from 'react-flexbox-grid'
import { fetchInteriorMain } from '../actions'
import Slider from 'react-slick'
import Transition from 'react-motion-ui-pack'
import {Motion, spring} from 'react-motion'
import {prevIcon, nextIcon} from '../svg/controls'
import anime from 'animejs'

class FullscreenCarousel extends Component {
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

export class InteriorImages extends Component {
  constructor(props) {
    super(props);
    this.state = { index: 1, isOpen: false, loaded: false };

    this.openLightBox = this.openLightBox.bind(this);
    this.closeLightbox = this.closeLightbox.bind(this);
  }
  componentWillMount() {
      const { fetchInteriorMain } = this.props;
    //  fetchInterior();
      fetchInteriorMain();
  }
  closeLightbox(e) {
    e.stopPropagation();
    this.setState({
      isOpen: false
    })
  }
  openLightBox( index ) {
      var images = this.props.interior.main;
      console.log(' _openLightBox: ', images );
      this.setState({
        index: index, isOpen: true
      })
  }
  render(){

    var self = this,
    imagesData = this.props.interior.main,
    imagesList = imagesData,
    images;

   // console.log('InteriorImages props: ', imagesList);

    var images = imagesList.map( (obj, key) => {
     // console.log('imagez', obj);
      return(
        <div className="col-xs-6 col-md-3 interior-item" key={key} onClick={self.openLightBox.bind(this, key)} >
          <div className="interior-image-link" >
            <div className="image-overlay" />
            <div className="interior-image" style={{ backgroundImage: 'url(' + obj.full + ')' }} />
             {/* <img className="interior-image" src={obj.full} />*/}
          </div>
        </div>
      )
    });

   // console.log('InteriorImages sasa', images);


    function placeX(isOpen){
      if(isOpen){
        return(
          <div className="fullscreen-carousel-close" onClick={self.closeLightbox.bind(this)}><i className="flaticon-cross-out"></i></div>
        )
      }
    }

    return(
       <section className="interior-grid">
         {placeX(this.state.isOpen)}
         <FullscreenCarousel items={imagesList} isOpen={this.state.isOpen} first={this.state.index} />
         <div id="interior" className="container-fluid">
            {images}
         </div>
       </section>
    )
  }
}

function mapStateToProps(state) {
    const interior = state.interior;

    // console.log('mapStateToProps (interior): ', state);

    return {
        interior: interior
    };
}

export default connect(
    mapStateToProps,
    { fetchInteriorMain }
)(InteriorImages);
