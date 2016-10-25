import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'

import { Grid, Row, Col } from 'react-flexbox-grid'
import { fetchInteriorMain } from '../actions'
import FullscreenCarousel from '../components/FullscreenCarousel'

import anime from 'animejs'

export class InteriorImages extends Component {
  constructor(props) {
    super(props);
    this.state = { index: 1, isOpen: false, loaded: false };

    this.openLightBox = this.openLightBox.bind(this);
    this.closeLightbox = this.closeLightbox.bind(this);
  }
  componentWillMount() {
      const { fetchInteriorMain } = this.props;
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
      this.setState({
        index: index, isOpen: true
      })
  }
  render(){

    var self = this,
    imagesData = this.props.interior.main,
    imagesList = imagesData,
    images,
    maximum = this.props.max || 8;

    var images = imagesList.map( (obj, key) => {
      var thumbSrc = obj.sizes.thumbnail.source_url || obj.full;
      if ( key < maximum ) return(
        <div className="col-xs-6 col-md-3 interior-item" key={key} onClick={self.openLightBox.bind(this, key)} >
          <div className="interior-image-link" >
            <div className="image-overlay" />
            <div className="interior-image" style={{ backgroundImage: 'url(' + thumbSrc + ')' }} />
          </div>
        </div>
      )
    });

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

    return {
        interior: interior
    };
}

export default connect(
    mapStateToProps,
    { fetchInteriorMain }
)(InteriorImages);
