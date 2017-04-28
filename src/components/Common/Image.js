import { React, Component } from 'react'

export default class ImageComponent extends Component {
  handleImageLoaded(e) {
    console.log('loaded!', e)
  }
  render() {
    console.log(this.props)
    return (
      <img
        src={this.props.src}
        alt={this.props.alt || '...'}
        onLoad={this.handleImageLoaded.bind(this)}
      />
    )
  }
}
