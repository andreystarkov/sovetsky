import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
// import * as LexiActions from '../actions'
import { Grid, Row, Col } from 'react-flexbox-grid'
import { fetchInterior } from '../actions'
import Lightbox from 'react-images'
import Carousel from 'nuka-carousel'

// console.log('LG', lightGallery);

class FullscreenCarousel extends Component {
  render(){
    var items = this.props.images.map( ( obj, key ) => {
      return (
        <img src={obj.full}/>
      )
    });

    console.log('FullscreenCarousel: ', items);

    return(
      <Carousel>
        {items}
      </Carousel>
    )
  }
}
export class InteriorImages extends Component {
  constructor(props) {
    super(props);
    this.state = { index: 0, isOpen: false };

    this.openLightBox = this.openLightBox.bind(this);
    this.closeLightbox = this.closeLightbox.bind(this);
  }
  componentWillMount() {
      const { fetchInterior } = this.props;
      fetchInterior();
  }

  componentDidMount() {

  }
  closeLightbox(e) {
    e.stopPropagation();
    this.setState({
      isOpen: false
    })
  }
  openLightBox( index ) {
      var images = this.props.interior.interior[0];

      console.log(' _openLightBox: ', images, 'index: '+index, images[index].full );

      this.setState({
        index: index, isOpen: true
      })
  }
  render(){

    var self = this,
    imagesData = this.props.interior,
    imglist = imagesData.interior[0],
    lightbox = '';

    if( this.state.isOpen && this.state.index ){
      //  var openImage = imglist[this.state.index].full;
        console.log('open: ', openImage, this.state.index);
/*        lightbox = (
            <Lightbox
                mainSrc={openImage}

                onCloseRequest={this.closeLightbox}
            />
        );*/
    }

    if( imagesData.interior.length > 0 ){
      var images = imagesData.interior[0].map( (obj, key) => {
        return(
          <div className="col-xs-6 col-md-3 interior-item" key={key} onClick={self.openLightBox.bind(this, key)} >
            <div className="interior-image-link" >
              <div className="image-overlay" />
              <div className="interior-image" style={{ backgroundImage: 'url(' + obj.full + ')' }} />
               {/* <img className="interior-image" src={obj.full} />*/}

            </div>
          </div>
        )
      })
    }

    console.log('InteriorImages', images);

    return(
       <section className="interior-grid">
         <div id="interior" className="container-fluid">
            {images}
         </div>
       </section>
    )
  }
}

function mapStateToProps(state) {
    const interior = state.interior;

    console.log('mapStateToProps (interior): ', state);

    return {
        interior: interior
    };
}

export default connect(
    mapStateToProps,
    { fetchInterior }
)(InteriorImages);
