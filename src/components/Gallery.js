import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'

import { fetchGallery } from '../actions'
import FullscreenCarousel from '../components/FullscreenCarousel'

export class Gallery extends Component {
  constructor(props) {
    super(props)
    this.state = { index: 1, isOpen: false, loaded: false }

    this.openLightBox = this.openLightBox.bind(this)
    this.closeLightbox = this.closeLightbox.bind(this)
  }
  componentWillMount() {
    const { fetchGallery } = this.props
    fetchGallery()
  }
  closeLightbox(e) {
    e.stopPropagation()
    this.setState({
      isOpen: false
    })
  }
  openLightBox(index) {
    var images = this.props.gallery.items
    this.setState({
      index: index, isOpen: true
    })
  }
  render() {
    ;

    var self = this,
      imagesData = this.props.gallery.items,
      imagesList = imagesData,
      images

    var images = imagesList.map((obj, key) => {
      return (
        <div className='col-xs-6 col-md-3 interior-item' key={key} onClick={self.openLightBox.bind(this, key)} >
          <div className='interior-image-link' >
            <div className='image-overlay' />
            <div className='interior-image' style={{ backgroundImage: 'url(' + obj.full + ')' }} />
          </div>
        </div>
      )
    })

    function placeX(isOpen) {
      if (isOpen) {
        return (
          <div className='fullscreen-carousel-close' onClick={self.closeLightbox.bind(this)}><i className='flaticon-cross-out' /></div>
        )
      }
    }

    return (
      <section className='interior-grid'>
        {placeX(this.state.isOpen)}
        <FullscreenCarousel items={imagesList} isOpen={this.state.isOpen} first={this.state.index} />
        <div id='interior' className='container-fluid'>
          {images}
        </div>
      </section>
    )
  }
}

function mapStateToProps(state) {
  const gallery = state.gallery

  return {
    gallery: gallery
  }
}

export default connect(
    mapStateToProps,
    { fetchGallery }
)(Gallery)
